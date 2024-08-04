<?php

namespace App\Controllers\Admin;

use App\Settings\Database;
use App\Templates\View;
use App\Interfaces\BaseControllerInterface;
use Doctrine\ORM\EntityManagerInterface;

class BaseController implements BaseControllerInterface
{
  /**
   * Returns the contents of a re-rendered view.
   * @param string $template
   * @param array $data
   * @return string
   */
  public function render(string $template, array $data = []): string
  {
    $path = BaseControllerInterface::ADMIN_VIEW_PATH . "/$template.html";
    $data['base_url'] = $_ENV['BASE_URL'] ?? '';

    $view = View::view()->render($path, $data);
    return $view;
  }

  /**
   * Returns the database manager object.
   * @return \Doctrine\ORM\EntityManagerInterface
   */
  public function db(): EntityManagerInterface
  {
    $entityManager = Database::manager();
    return $entityManager;
  }
}