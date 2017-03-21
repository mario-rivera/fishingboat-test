<?php 
namespace App\Http\Controllers;

use Twig_Environment;
use App\Models\HPCalculator;

class CalculateController{
    /**
     * @var Twig_Environment
     */
    private $twig;
     
    public function __construct(Twig_Environment $twig)
    {
        $this->twig = $twig;
    }
    
    public function getCalculate( HPCalculator $calculator ){
        $calculator->setParametersFromRequest( $_GET );
        
        return $this->twig->render('calculate/calculate.html', [
            'hullspeed'     => $calculator->calculateTheoreticalHullSpeed(),
            'calculator'    => $calculator
        ]);
    }
}