<?php

namespace App\Controllers\Site\Web;

use App\Controllers\Site\BaseController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class SearchController extends BaseController
{
  public function index(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $view = $this->render('home', [
      'page_title' => 'Home'
    ]);
    $response->getBody()->write($view);

    return $response;
  }
}