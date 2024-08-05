<?php

namespace App\Middlewares\Admin;

use App\Entities\Category;
use App\Settings\Database;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Http\Message\ResponseInterface;
use Respect\Validation\Validator as v;
use Slim\Psr7\Response;
use Slim\Psr7\UploadedFile;

class CheckPostCreationMiddleware implements MiddlewareInterface
{
  private array $fields;
  private array $errors;

  private function validateTitle(string $title): void
  {
    if (!v::regex('/^[a-zA-Z0-9\s\'"\-.,!?À-ÖØ-öø-ÿ]{5,100}$/')->validate($title)) {
      $this->errors['title'] = 'Invalid title';
    }
  }

  private function validateSlug(string $slug): void
  {
    if (!v::regex('/^[a-z0-9]+(?:-[a-z0-9]+)*$/')->validate($slug)) {
      $this->errors['slug'] = 'Invalid slug';
    }
  }

  private function validateCategory(int $categoryId): void
  {
    $dbManager = Database::manager();
    $category = $dbManager->getRepository(Category::class)->find($categoryId);

    if (!$category instanceof Category) {
      $this->errors['category'] = 'Invalid category';
    }
  }

  private function validateBody(string $body): void
  {
    if (!v::stringType()->length(1, 4294967295)->validate($body)) {
      $this->errors['body'] = 'Invalid post body';
    }
  }

  private function validateImage(UploadedFile $image): void
  {
    if (!is_null($image)) {
      if (!v::image()->validate($image->getClientMediaType())) {
        $this->errors['image'] = 'The image sent is not valid';
      } else {
        $this->validateImageSize($image);
      }
    } else {
      $this->errors['image'] = 'Image is mandatory';
    }
  }
  private function validateImageSize(UploadedFile $image): void
  {
    if ($image->getSize() > 2 * 1024 * 1024) {
      $this->errors['image'] = 'The image must be a maximum of 2MB';
    }
  }

  private function fillInFields(ServerRequestInterface $request): void
  {
    $title = $request->getParsedBody()['title'] ?? '';
    $slug = $request->getParsedBody()['slug'] ?? '';
    $categoryId = (int) ($request->getParsedBody()['category'] ?? '');
    $body = $request->getParsedBody()['body'] ?? '';

    $this->fields['title'] = $title;
    $this->fields['slug'] = $slug;
    $this->fields['category_id'] = $categoryId;
    $this->fields['body'] = $body;
  }

  private function startsFieldsAndErrors(ServerRequestInterface $request)
  {
    $this->errors = $request->getAttribute('errors') ?? [];
    $this->fields = $request->getAttribute('fields') ?? [];
  }

  public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
  {
    $this->startsFieldsAndErrors($request);

    $this->fillInFields($request);

    $uploadedFiles = $request->getUploadedFiles();
    $image = $uploadedFiles['image'] ?? null;

    $this->validateTitle($this->fields['title']);
    $this->validateSlug($this->fields['slug']);
    $this->validateCategory($this->fields['category_id']);
    $this->validateBody($this->fields['body']);
    $this->validateImage($image);

    $request = $request->withAttribute('errors', $this->errors);
    $request = $request->withAttribute('fields', $this->fields);

    return $handler->handle($request);
  }
}