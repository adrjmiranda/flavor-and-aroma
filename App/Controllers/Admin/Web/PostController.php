<?php

namespace App\Controllers\Admin\Web;

use App\Controllers\Admin\BaseController;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class PostController extends BaseController
{
  public function index(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $view = $this->render('posts', [
      'page_title' => 'Posts',
      'active' => 'posts'
    ]);
    $response->getBody()->write($view);

    return $response;
  }

  public function add(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $errors = $request->getAttribute('session')->getFlashBag()->get('errors');
    $fields = $request->getAttribute('session')->get('fields');

    $view = $this->render('add_post', [
      'page_title' => 'Add post',
      'csrf' => $request->getAttribute('session')->get('csrf'),
      'errors' => $errors,
      'fields' => $fields,
      'active' => ''
    ]);
    $response->getBody()->write($view);

    return $response;
  }

  public function store(ServerRequestInterface $request, ResponseInterface $response, array $args): ResponseInterface
  {
    $view = $this->render('add_post', [
      'page_title' => 'Add post',
      'active' => ''
    ]);
    $response->getBody()->write($view);

    return $response;
  }
}