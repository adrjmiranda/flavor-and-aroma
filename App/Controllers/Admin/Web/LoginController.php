<?php

namespace App\Controllers\Admin\Web;

use App\Controllers\Admin\BaseController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LoginController extends BaseController
{
  public function index(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $errors = $request->getAttribute('session')->getFlashBag()->get('errors');
    $fields = $request->getAttribute('session')->getFlashBag()->get('fields');

    $view = $this->render('login', [
      'page_title' => 'Login',
      'csrf' => $request->getAttribute('session')->get('csrf'),
      'errors' => $errors,
      'fields' => $fields,
    ]);
    $response->getBody()->write($view);

    return $response;
  }

  public function store(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $body = $request->getParsedBody();

    return $response;
  }
}