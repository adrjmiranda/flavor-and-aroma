<?php

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Slim\Psr7\Response;

function referer(ServerRequestInterface $request): ResponseInterface
{
  $response = new Response();
  $referer = 'javascript:history.go(-1)';
  if (isset($request->getServerParams()['HTTP_REFERER'])) {
    $referer = filter_var($request->getServerParams()['HTTP_REFERER'], FILTER_SANITIZE_URL);
  }

  return $response->withHeader('Location', $referer)->withStatus(302);
}