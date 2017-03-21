<?php 
$container = require __DIR__ . '/../app/bootstrap/bootstrap.php';

echo $container->call(
    ['App\Http\Routing\RouteDispatcher', 'dispatch'], 
    [$_SERVER['REQUEST_METHOD'], parse_url( $_SERVER['REQUEST_URI'], PHP_URL_PATH )]
);