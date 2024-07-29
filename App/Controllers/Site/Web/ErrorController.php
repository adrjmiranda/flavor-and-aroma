<?php

namespace App\Controllers\Site\Web;

use App\Controllers\Site\BaseController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class ErrorController extends BaseController
{
  public function notFound(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $view = $this->render('404', [
      'page_title' => '404 Error'
    ]);
    $response->getBody()->write($view);

    return $response;
  }
}