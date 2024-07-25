<?php

namespace App\Controllers\Site;

use App\Controllers\BaseController;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

class HomeController extends BaseController
{
  public function index(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $view = $this->render('site/pages/home/home.html', [
      'base_url' => 'http://localhost:8000'
    ]);
    $response->getBody()->write($view);

    return $response;
  }

  public function component(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $component = $args['component'] ?? '';

    $view = $this->render("site/components/$component/$component.html");
    $response->getBody()->write($view);

    return $response;
  }
}