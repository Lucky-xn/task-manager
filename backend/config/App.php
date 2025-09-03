<?php
require_once __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;
use Services\CORS;

$cors = new CORS();

$cors->apply();

$dotenv = Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->load();

require_once __DIR__ . '/SystemRouter.php';
require_once __DIR__ . '/../routes/Routes.php';