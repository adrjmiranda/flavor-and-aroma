<?php

use App\Controllers\Admin\Web\LoginController;
use Slim\Routing\RouteCollectorProxy;

$app->group('/admin', function (RouteCollectorProxy $group) {
  $group->get('/login', LoginController::class . ':index');
});