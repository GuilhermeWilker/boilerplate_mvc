<?php

session_start();

require '../vendor/autoload.php';
include "../routes/web.php";

$dotenv = Dotenv\Dotenv::createImmutable(dirname(__FILE__, 2));
$dotenv->load();



