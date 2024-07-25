<?php

require_once __DIR__ . "/../bootstrap.php";

// Add routes
require_once __DIR__ . "/../App/routes/main.php";

// Run Slim

$app->run();