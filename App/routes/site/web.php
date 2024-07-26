<?php

use App\Controllers\Site\Web\AboutController;
use App\Controllers\Site\Web\ContactController;
use App\Controllers\Site\Web\HomeController;

$app->get('/', HomeController::class . ':index');
$app->get('/about', AboutController::class . ':index');
$app->get('/contact', ContactController::class . ':index');