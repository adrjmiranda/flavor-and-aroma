<?php

require_once __DIR__ . "/vendor/autoload.php";

use Dotenv\Dotenv;
use Slim\Factory\AppFactory;
use App\Middlewares\NotFoundMiddleware;

// Init Dotenv
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Init Slim
$app = AppFactory::create();

$app->addBodyParsingMiddleware();

$app->add(new NotFoundMiddleware);