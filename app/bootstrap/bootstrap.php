<?php
/**
 * The bootstrap file creates and returns the container.
 */

use DI\ContainerBuilder;
// define the root directory for the project
define( 'BASE_DIR', __DIR__ . '/../../' );
// load composer
require rtrim(BASE_DIR, '/') . '/vendor/autoload.php';
// start the IoC for the application
$containerBuilder = new ContainerBuilder;
$containerBuilder->addDefinitions(__DIR__ . '/di.php');
$container = $containerBuilder->build();

return $container;