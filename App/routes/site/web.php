<?php
use App\Controllers\Site\Web\HomeController;

$app->get('/', HomeController::class . ':index');