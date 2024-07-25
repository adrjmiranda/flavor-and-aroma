<?php

use App\Controllers\Site\HomeController;

$app->get("/site/pages/home", HomeController::class . ':index');
$app->get("/site/components/{component:[a-z]+}", HomeController::class . ':component');