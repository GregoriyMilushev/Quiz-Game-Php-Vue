<?php
require_once __DIR__ . '/../Requests/Request.php';

abstract class BaseController {

    protected $request;

    public function __construct(Request $request) {
        $this->request = $request;
    }

    abstract public function index();
    abstract public function show($id);

    public function sendJson($data) {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: http://127.0.0.1:5173');
        echo json_encode($data);
    }
}