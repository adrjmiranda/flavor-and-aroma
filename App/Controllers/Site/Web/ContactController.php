<?php

namespace App\Controllers\Site\Web;

use App\Controllers\Site\BaseController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ContactController extends BaseController
{
  public function index(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $view = $this->render('contact', [
      'page_title' => 'Contact Us'
    ]);
    $response->getBody()->write($view);

    return $response;
  }
}