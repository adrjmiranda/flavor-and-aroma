<?php

namespace App\Middlewares\Admin;

use App\Entities\Admin;
use App\Settings\Database;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;

class CheckLoginMiddleware implements MiddlewareInterface
{
  public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
  {
    $fields = [];
    $email = $request->getParsedBody()['email'] ?? '';
    $password = $request->getParsedBody()['password'] ?? '';

    $fields['email'] = $email;
    $fields['password'] = $password;

    $dbManager = Database::manager();
    $admin = $dbManager->getRepository(Admin::class)->findOneBy(array('email' => $email));

    $errors = $request->getAttribute('errors') ?? [];
    if (!$admin instanceof Admin) {
      $errors['email'] = 'This email is not registered';
    } else if (!password_verify($password, $admin->getPassword())) {
      $errors['password'] = 'Incorrect password';
    } else {
      $session = $request->getAttribute('session');
      $data = [
        'id' => $admin->getId(),
        'name' => $admin->getName(),
        'email' => $admin->getEmail(),
      ];

      $session->set('admin', $data);
    }
    $request = $request->withAttribute('errors', $errors);
    $request = $request->withAttribute('fields', $fields);

    return $handler->handle($request);
  }
}