<?php

namespace App\Controllers\Admin\Web;

use App\Controllers\Admin\BaseController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class UserController extends BaseController
{
  public function index(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $view = $this->render('users', [
      'page_title' => 'Users',
      'active' => 'users'
    ]);
    $response->getBody()->write($view);

    return $response;
  }
}