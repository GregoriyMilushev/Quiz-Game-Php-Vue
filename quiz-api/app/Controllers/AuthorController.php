<?php

require_once __DIR__ . '/../Models/Quote.php';
require_once __DIR__ . '/../Models/Author.php';
require_once __DIR__ . '/BaseController.php';

class AuthorController extends BaseController {
    public function index() {
        $authorModel = new Author();
        $authors = $authorModel->all();
        return $this->sendJson($authors);
    }

    public function show($id) {
        $authorModel = new Author();
        $author = $authorModel->find($id);
        $author->quotes = $author->quotes();
        return $this->sendJson($author);
    }
}