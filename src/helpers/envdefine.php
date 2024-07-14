<?php

session_start();

$dbHost = getenv('DB_HOST') ?: 'mysql-db';
$dbPort = getenv('DB_PORT') ?: '3311';
$username = getenv('DB_USERNAME');
$password = getenv('DB_PASSWORD');
$database = getenv('DB_DATABASE');

// // if (!$username || !$password || !$database) {
// //     echo 'One or more required environment variables are missing';
// //     echo 'DB_USERNAME: ' . ($username ? 'set' : 'missing') . PHP_EOL;
// //     echo 'DB_PASSWORD: ' . ($password ? 'set' : 'missing') . PHP_EOL;
// //     echo 'DB_DATABASE: ' . ($database ? 'set' : 'missing') . PHP_EOL;
// //     die();
// // }

define('DB_HOST', $dbHost);
define('DB_PORT', $dbPort);
define('DB_USERNAME', $username);
define('DB_PASSWORD', $password);
define('DB_DATABASE', $database);

// Use these constants for your database connection