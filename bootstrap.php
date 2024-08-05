<?php

require_once __DIR__ . "/vendor/autoload.php";

use App\Middlewares\SessionMiddleware;
use Dotenv\Dotenv;
use Slim\Factory\AppFactory;
use App\Middlewares\NotFoundMiddleware;

use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;
use Symfony\Component\HttpFoundation\Session\Storage\Handler\NativeFileSessionHandler;

// Init session
$sessionStorage = new NativeSessionStorage([
  'cookie_lifetime' => 3600,
  'cookie_secure' => true,
  'cookie_httponly' => true,
], new NativeFileSessionHandler());

$session = new Session($sessionStorage);
$session->start();

// Init Dotenv
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Init Slim
$app = AppFactory::create();

$container = $app->getContainer();
$container['session'] = function () use ($session) {
  return $session;
};

$app->addBodyParsingMiddleware();
$app->addErrorMiddleware(true, true, true);

$app->add(new SessionMiddleware($session));
$app->add(new NotFoundMiddleware);