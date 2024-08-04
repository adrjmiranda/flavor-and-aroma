<?php

namespace App\Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Respect\Validation\Exceptions\NestedValidationException;
use Respect\Validation\Validator as v;

class CheckCSRFTokenMiddleware implements MiddlewareInterface
{
  public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
  {
    $sessionCsrf = $request->getAttribute('session')->get('csrf');
    $csrfReceived = $request->getParsedBody()['csrf'] ?? '';

    $errors = [];
    if (!v::equals($sessionCsrf)->validate($csrfReceived)) {
      $message = 'Invalid credentials';
      $errors['csrf'] = $message;
    }
    $request = $request->withAttribute('errors', $errors);

    return $handler->handle($request);
  }
}