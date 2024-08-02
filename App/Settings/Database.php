<?php

namespace App\Settings;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Configuration;

class Database
{
  private static ?EntityManagerInterface $entityManager = null;

  public static function manager(): EntityManagerInterface
  {
    if (is_null(self::$entityManager)) {
      $params = self::dbParams();
      $config = self::dbConfig();
      $connection = DriverManager::getConnection($params, $config);

      self::$entityManager = new EntityManager($connection, $config);
    }

    return self::$entityManager;
  }

  private static function dbConfig(): Configuration
  {
    return ORMSetup::createAttributeMetadataConfiguration(
      paths: array(__DIR__ . '/../Entities'),
      isDevMode: true
    );
  }

  private static function dbParams(): array
  {
    $params = require_once __DIR__ . '/../../config/db.php';
    return $params;
  }
}