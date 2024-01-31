<?php
namespace app\controllers;

class NotFoundController
{
    public function __construct()
    {
        http_response_code(404);
    }

    public function index()
    {
        echo '<h1>404 Not Found</h1>';
    }
}