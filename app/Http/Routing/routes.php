<?php 

$router->addRoute( 'GET', '/', ['App\Http\Controllers\HomeController','getIndex'] );
$router->addRoute( 'GET', '/calculate', ['App\Http\Controllers\CalculateController','getCalculate'] );