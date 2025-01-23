<?php

use Prometheus\CollectorRegistry;
use Prometheus\RenderTextFormat;
use Prometheus\Storage\InMemory;

require 'vendor/autoload.php';

try {
    $registry = new CollectorRegistry(new InMemory());
    $counter = $registry->getOrRegisterCounter('php_app', 'requests', 'Number of requests', ['method', 'endpoint']);
    $counter->inc([$_SERVER['REQUEST_METHOD'], $_SERVER['REQUEST_URI']]);
    
    $gauge = $registry->getOrRegisterGauge(
        'server',
        'disk_free_space_bytes',
        'Free disk space in bytes',
        ['path']
    );
    $gauge->set(rand(1000, 2000), ['/']);
    
    if ($_SERVER['REQUEST_URI'] === '/metrics') {
        header('Content-Type: text/plain');
        $renderer = new RenderTextFormat();
        echo $renderer->render($registry->getMetricFamilySamples());
        exit;
    }
} catch (Exception $e) {
    var_dump(
        $e->getMessage(),
        $e->getTraceAsString()
    );
}

echo "Hello, World!";
