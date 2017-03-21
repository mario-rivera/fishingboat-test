<?php
use DI\Container;
use function DI\object;
use function DI\factory;

return [
    'app.basedir'  => BASE_DIR,
    Twig_Environment::class => factory('App\Services\Twig\TwigService::register')
];
