<?php

require_once __DIR__ . '/../vendor/autoload.php';

$router = new \App\System\Routing\Router();

$router->registerRoutesFromControllers();
//$router->add('attributes/case-1', [\App\Controllers\AttributesDemoController::class, 'case1']);

$router->run();