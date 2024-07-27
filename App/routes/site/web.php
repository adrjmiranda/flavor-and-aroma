<?php

use App\Controllers\Site\Web\HomeController;
use App\Controllers\Site\Web\AboutController;

$app->get('/', HomeController::class . ':index');
$app->get('/about', AboutController::class . ':index');