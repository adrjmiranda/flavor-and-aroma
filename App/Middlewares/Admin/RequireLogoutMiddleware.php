<?php

namespace App\Middlewares\Admin;

use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Slim\Psr7\Response;

class RequireLogoutMiddleware implements MiddlewareInterface
{
  public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
  {
    $session = $request->getAttribute('session');
    $admin = $session->get('admin');

    if ($admin) {
      $response = new Response();
      return $response->withHeader('Location', '/admin/dashboard')->withStatus(302);
    }

    return $handler->handle($request);
  }
}