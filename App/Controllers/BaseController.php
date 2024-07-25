<?php

namespace App\Controllers;

use App\Templates\View;

class BaseController
{
  protected function render(string $template, array $data = []): string
  {
    return View::view()->render($template, $data);
  }
}