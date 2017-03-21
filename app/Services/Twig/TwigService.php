<?php 
namespace App\Services\Twig;

use DI\Container;
use Twig_Loader_Filesystem;
use Twig_Environment;

class TwigService{
    
    public function register( Container $container ){
        $loader = new Twig_Loader_Filesystem( rtrim($container->get('app.basedir'), '/') . '/app/Views/Twig' );
        $twig = new Twig_Environment( $loader, ['cache' => false] );
        
        $twig->addGlobal('app', $container);
        
        return $twig;
    }
}