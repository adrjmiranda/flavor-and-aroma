<?php

$dbHost = $_ENV['DB_HOST'] ?? '';
$dbName = $_ENV['DB_NAME'] ?? '';
$dbUser = $_ENV['DB_USER'] ?? '';
$dbPass = $_ENV['DB_PASS'] ?? '';

return [
  'driver' => 'pdo_mysql',
  'host' => $dbHost,
  'user' => $dbUser,
  'password' => $dbPass,
  'dbname' => $dbName,
  'memory' => true
];