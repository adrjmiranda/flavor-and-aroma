<?php

namespace App\Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class SessionMiddleware implements MiddlewareInterface
{
  private Session $session;

  public function __construct(Session $session)
  {
    $this->session = $session;
  }

  public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
  {
    $request = $request->withAttribute('session', $this->session);

    return $handler->handle($request);
  }
}