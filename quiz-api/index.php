<?php
require_once __DIR__ . '/app/Controllers/AuthorController.php';
require_once __DIR__ . '/app/Controllers/QuoteController.php';
require_once __DIR__ . '/app/Requests/Request.php';
require_once __DIR__ . '/vendor/autoload.php';

// Define your routes
$router = new \Bramus\Router\Router();


// Define a GET route for retrieving a single author
$router->get('/author/(\d+)', function($id) {
    $request = new Request();
    $controller = new AuthorController($request);
    $controller->show($id);
});

// Define a GET route for retrieving all authors
$router->get('/author', function() {
    $request = new Request();
    $controller = new AuthorController($request);
    $controller->index();
});

// Define a GET route for retrieving a single quote
$router->get('/quote/(\d+)', function($id) {
    $request = new Request();
    $controller = new QuoteController($request);
    $controller->show($id);
});

// Define a GET route for retrieving all quotes
$router->get('/quote', function()  {
    $request = new Request();
    $controller = new QuoteController($request);
    $controller->index();
});

//Get random quote with, the real and two other answers
$router->get('/quote/random', function() {
    $request = new Request();
    $controller = new QuoteController($request);
    $controller->random();
});

//Check the answer
$router->get('/quote/check', function() {
    $request = new Request();
    $controller = new QuoteController($request);
    $controller->check();
});


$router->run();
