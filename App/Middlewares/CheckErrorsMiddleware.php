<?php

namespace App\Middlewares;

use App\Utils\Router;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Symfony\Component\HttpFoundation\Session\Session;

class CheckErrorsMiddleware implements MiddlewareInterface
{
  private Session $session;

  public function __construct(Session $session)
  {
    $this->session = $session;
  }

  public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
  {
    $errors = $request->getAttribute('errors') ?? [];
    $fields = $request->getAttribute('fields') ?? [];

    if (!empty($fields)) {
      $this->session->set('fields', $fields);
    }

    if (!empty($errors)) {
      $flashBag = $this->session->getFlashBag();
      foreach ($errors as $key => $message) {
        $flashBag->add('errors', [$key => $message]);
      }
      $request = $request->withAttribute('errors', []);

      return Router::referer($request);
    }

    return $handler->handle($request);
  }
}