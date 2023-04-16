<?php

require_once __DIR__ . '/../Models/Quote.php';
require_once __DIR__ . '/../Models/Author.php';
require_once __DIR__ . '/BaseController.php';

class QuoteController extends BaseController {

    public function __construct(Request $request) {
        parent::__construct($request);
    }

    public function index() {
        $quoteModel = new Quote();
        $quotes = $quoteModel->all();
        return $this->sendJson($quotes);
    }

    public function show($id) {
        $quoteModel = new Quote();
        $quote = $quoteModel->find($id);
        $quote->author = $quote->author();
        return $this->sendJson($quote);
    }

    public function random() {
        $quoteModel = new Quote();
        $authorModel = new Author();

        // Get the array of excluded quote IDs from the request
        $excludedIds = $this->request->get('ids');

        // Get a random quote that is not in the excluded IDs array
        $quote = $quoteModel->random($excludedIds);

        // Get the author related to the quote
        $author = $quote->author();
        // Get two other random authors
        $randomAuthors = $authorModel->random(2, [$quote->author_id]);

        $authors = array_merge([$author], $randomAuthors);

        // Create a random array with the same length
        $rand = range(1, count($authors));
        shuffle($rand);

        array_multisort($rand, SORT_ASC, $authors);
        $result = [
            'quote' => [
                'id' => $quote->id,
                'text' => $quote->quote
            ],
            'authors' => $authors
        ];

        $this->sendJson($result);
    }

    public function check() {
        $quoteModel = new Quote();
        $quoteId = $this->request->get('quote_id');
        $answerId = $this->request->get('answer_id');

        $quote = $quoteModel->find($quoteId);

        $result = [
            'answer' => $answerId == $quote->author_id
        ];

        $this->sendJson($result);
    }
}