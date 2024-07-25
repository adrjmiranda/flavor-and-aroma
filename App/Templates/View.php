<?php

namespace App\Templates;

use Twig\Loader\FilesystemLoader;
use Twig\Environment;

class View
{
  private static ?Environment $twig = null;

  private static function loader(): FilesystemLoader
  {
    return new FilesystemLoader(dirname(__FILE__, 2) . '/Views');
  }

  public static function view()
  {
    if (is_null(self::$twig)) {
      self::$twig = new Environment(self::loader(), [
        'auto_reload' => true,
        // 'cache' => ''
      ]);
    }

    return self::$twig;
  }
}