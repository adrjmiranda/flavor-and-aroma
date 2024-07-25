<?php

namespace App\Interfaces;

interface BaseControllerInterface
{
  public const SITE_VIEW_PATH = "site";
  public const ADMIN_VIEW_PATH = "admin";

  public function render(string $template, array $data = []): string;
}