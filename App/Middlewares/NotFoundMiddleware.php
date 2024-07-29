<?php

namespace App\Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;

class NotFoundMiddleware implements MiddlewareInterface
{
  public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
  {
    $response = $handler->handle($request);

    if ($response->getStatusCode() === 404) {
      $res = new Response();
      return $res->withHeader('Location', '/404')->withStatus(302);
    }

    return $response;
  }
}