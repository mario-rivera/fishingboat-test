<?php 
namespace App\Http\Controllers;

use Twig_Environment;

class HomeController{
    
    /**
     * @var Twig_Environment
     */
    private $twig;

    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }
    
    public function getIndex(){
        return $this->twig->render('home/index.html', []);
    }
}