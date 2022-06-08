<?php
require('../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable('../');
$dotenv->safeLoad();

$db_host = $_ENV['DB_HOST'];
$db_username = $_ENV['DB_USERNAME'];
$db_password = $_ENV['DB_PASSWORD'];
$db_name = $_ENV['DB_NAME'];

$conn = new mysqli($db_host, $db_username, $db_password, $db_name);
$conn->set_charset('utf8');
