<?php

use Symfony\Component\Dotenv\Dotenv;

require_once('vendor/autoload.php');

$dotenv = new Dotenv();
$dotenv->load(__DIR__.'/.env');

echo $_SERVER['DB_HOST'];
echo "<br/>";
echo $_SERVER['LOG_DIR'];
