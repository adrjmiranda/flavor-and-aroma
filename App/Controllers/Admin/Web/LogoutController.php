<?php

namespace App\Controllers\Admin\Web;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class LogoutController
{
  public function index(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $session = $request->getAttribute('session');
    $session->remove('admin');

    return $response->withHeader('Location', '/admin/login')->withStatus(302);
  }
}