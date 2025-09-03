<?php
use Config\SystemRouter;
$router = new SystemRouter();

include_once __DIR__ . '/System/User.php';

$router->run();