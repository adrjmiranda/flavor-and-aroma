<?php

namespace App\Controllers\Admin\Web;

use App\Controllers\Admin\BaseController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class DashboardController extends BaseController
{
  public function index(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $view = $this->render('home', [
      'page_title' => 'Dashboard',
      'active' => 'dashboard'
    ]);
    $response->getBody()->write($view);

    return $response;
  }
}