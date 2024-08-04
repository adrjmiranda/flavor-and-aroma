<?php

namespace App\Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class GenerateCSRFTokenMiddleware implements MiddlewareInterface
{
  private const LENGTH = 48;

  private function generate(): string
  {
    return bin2hex(random_bytes(self::LENGTH));
  }

  public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
  {
    $session = $request->getAttribute('session');
    $session->set('csrf', $this->generate());
    $request->withAttribute('session', $session);

    return $handler->handle($request);
  }
}