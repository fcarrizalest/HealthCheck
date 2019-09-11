<?php
use Cake\Routing\Router;

Router::plugin(
    'HealthCheck',
    ['path' => '/health-check'],
    function ($routes) {
        $routes->fallbacks('DashedRoute');
    }
);
