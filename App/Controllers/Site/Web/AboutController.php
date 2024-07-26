<?php

namespace App\Controllers\Site\Web;

use App\Controllers\Site\BaseController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class AboutController extends BaseController
{
  public function index(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $view = $this->render('about', [
      'page_title' => 'About Us'
    ]);
    $response->getBody()->write($view);

    return $response;
  }
}