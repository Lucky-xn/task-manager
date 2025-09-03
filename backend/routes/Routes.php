<?php

use Config\SystemRouter;

$router = new SystemRouter();

$router->addRoute('GET', '/test', 'testFile');

$router->run();