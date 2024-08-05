<?php

use App\Middlewares\Admin\RequireLoginMiddleware;
use Slim\Routing\RouteCollectorProxy;

// Middlewares
use App\Middlewares\GenerateCSRFTokenMiddleware;
use App\Middlewares\CheckErrorsMiddleware;
use App\Middlewares\CheckCSRFTokenMiddleware;
use App\Middlewares\Admin\CheckLoginMiddleware;

// Controllers
use App\Controllers\Admin\Web\DashboardController;
use App\Controllers\Admin\Web\LoginController;
use App\Controllers\Admin\Web\PostController;
use App\Controllers\Admin\Web\UserController;

// Get session
$ss = $session;

$app->group('/admin', function (RouteCollectorProxy $group) use ($ss) {
  $group->get('/login', LoginController::class . ':index')->add(new GenerateCSRFTokenMiddleware);
  $group->post('/login', LoginController::class . ':store')->add(new CheckErrorsMiddleware($ss))->add(new CheckCSRFTokenMiddleware)->add(new CheckLoginMiddleware);

  $group->group('/dashboard', function (RouteCollectorProxy $sub) {
    $sub->get('', DashboardController::class . ':index');
    $sub->get('/posts', PostController::class . ':index');
    $sub->get('/users', UserController::class . ':index');
  })->add(new RequireLoginMiddleware);

  $group->group('/post', function (RouteCollectorProxy $sub) use ($ss) {
    $sub->get('/add', PostController::class . ':add')->add(new GenerateCSRFTokenMiddleware);
    $sub->post('/add', PostController::class . ':store')->add(new CheckErrorsMiddleware($ss))->add(new CheckCSRFTokenMiddleware);
  })->add(new RequireLoginMiddleware);
});