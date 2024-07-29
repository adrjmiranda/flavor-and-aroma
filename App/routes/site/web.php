<?php

use App\Controllers\Site\Web\ErrorController;
use App\Controllers\Site\Web\HomeController;
use App\Controllers\Site\Web\AboutController;
use App\Controllers\Site\Web\PostController;

$app->get('/', HomeController::class . ':index');
$app->get('/about', AboutController::class . ':index');
$app->get('/post', PostController::class . ':index');
$app->get('/404', ErrorController::class . ':notFound');