<?php 
namespace App\Http\Controllers;

use Twig_Environment;
use App\Models\HPCalculator;
use Exception;

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
        try{
            $calculator->setParametersFromRequest( $_GET );
        } catch(Exception $e){
            // on a full framework you would use some proper redirection handled by a class with better messaging in the session
            header( "Location:/?". http_build_query( array_merge($_GET, ['e' => $e->getMessage()]) ) ); exit;
        }
        
        return $this->twig->render('calculate/calculate.html', [
            'hullspeed'     => $calculator->calculateTheoreticalHullSpeed(),
            'calculator'    => $calculator
        ]);
    }
}