<?php

require_once __DIR__ . '/bootstrap.php';

use App\Settings\Database;
use Doctrine\Migrations\Configuration\EntityManager\ExistingEntityManager;
use Doctrine\Migrations\DependencyFactory;
use Doctrine\Migrations\Configuration\Migration\PhpFile;

$config = new PhpFile('migrations.php');

$entityManager = Database::manager();

return DependencyFactory::fromEntityManager($config, new ExistingEntityManager($entityManager));