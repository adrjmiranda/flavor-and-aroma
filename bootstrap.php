<?php

session_start();

require_once __DIR__ . "/vendor/autoload.php";

use Dotenv\Dotenv;
use Slim\Factory\AppFactory;

// Init Dotenv
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Init Slim
$app = AppFactory::create();