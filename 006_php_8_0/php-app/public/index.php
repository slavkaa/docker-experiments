<?php

$rootDir = __DIR__ . '/../';

require_once $rootDir . 'vendor/autoload.php';

(new \App\System\Routing\Router())->run();