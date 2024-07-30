<?php

use Slim\Routing\RouteCollectorProxy;
use App\Controllers\Admin\Web\DashboardController;
use App\Controllers\Admin\Web\LoginController;
use App\Controllers\Admin\Web\PostController;
use App\Controllers\Admin\Web\UserController;

$app->group('/admin', function (RouteCollectorProxy $group) {
  $group->get('/login', LoginController::class . ':index');

  $group->group('/dashboard', function (RouteCollectorProxy $sub) {
    $sub->get('', DashboardController::class . ':index');
    $sub->get('/posts', PostController::class . ':index');
    $sub->get('/users', UserController::class . ':index');
  });
});