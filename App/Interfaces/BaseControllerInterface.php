<?php

namespace App\Interfaces;

use Doctrine\ORM\EntityManagerInterface;

interface BaseControllerInterface
{
  public const SITE_VIEW_PATH = "site/pages";
  public const ADMIN_VIEW_PATH = "admin/pages";

  public function render(string $template, array $data = []): string;
  public function db(): EntityManagerInterface;
}