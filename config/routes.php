<?php
use Cake\Routing\Router;

Router::plugin('FieldTypes', function ($routes) {
    $routes->fallbacks('InflectedRoute');
});
