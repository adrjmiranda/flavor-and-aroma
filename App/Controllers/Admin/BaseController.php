<?php

namespace App\Controllers\Admin;

use App\Templates\View;
use App\Interfaces\BaseControllerInterface;

class BaseController implements BaseControllerInterface
{
  public function render(string $template, array $data = []): string
  {
    $path = BaseControllerInterface::ADMIN_VIEW_PATH . "/$template.html";
    $data['base_url'] = $_ENV['BASE_URL'] ?? '';

    $view = View::view()->render($path, $data);
    return $view;
  }
}