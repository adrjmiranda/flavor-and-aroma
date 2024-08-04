<?php

namespace App\Middlewares;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Slim\Psr7\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class CheckErrorsMiddleware implements MiddlewareInterface
{
  private Session $session;

  public function __construct(Session $session)
  {
    $this->session = $session;
  }

  private function previous(ServerRequestInterface $request): string
  {
    $previous = 'javascript:history.go(-1)';

    if (isset($request->getServerParams()['HTTP_REFERER'])) {
      $previous = filter_var($request->getServerParams()['HTTP_REFERER'], FILTER_SANITIZE_URL);
    }

    return $previous;
  }

  public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
  {
    $errors = $request->getAttribute('errors');

    if (!empty($errors)) {
      $flashBag = $this->session->getFlashBag();
      foreach ($errors as $key => $message) {
        $flashBag->add($key, $message);
      }
      $request = $request->withAttribute('errors', []);

      $referer = $this->previous($request);
      $response = new Response();

      return $response->withHeader('Location', $referer)->withStatus(302);
    }

    return $handler->handle($request);
  }
}