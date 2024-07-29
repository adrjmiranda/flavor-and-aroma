<?php

namespace App\Interfaces;

interface BaseControllerInterface
{
  public const SITE_VIEW_PATH = "site/pages";
  public const ADMIN_VIEW_PATH = "admin/pages";

  public function render(string $template, array $data = []): string;
}