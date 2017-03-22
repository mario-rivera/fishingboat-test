<?php 
namespace App\Models;

use Respect\Validation\Validator;

class HPCalculator{
    /**
     * The hull length.
     *
     * @var int
     */
     
     protected $hull_length;
     /**
      * The buttock angle.
      *
      * @var int
      */
     protected $buttockangle;
     
     /**
      * The displacement.
      *
      * @var int
      */
     protected $displacement;     
     
     /**
     * Set the minimum properties required for the calculation.
     * Basic validation of parameters.
     *
     * @param array params
     */
     public function setParametersFromRequest( array $params ){
         // Note that this could al very well be float values
         Validator::intVal()->positive()->setName("Hull Length")->check( $params['hl'] );
         $this->hull_length = $params['hl'];
         
         Validator::intVal()->between(2, 7)->setName("Buttock Angle")->check( $params['ba'] );
         $this->buttockangle = $params['ba'];
         
         Validator::intVal()->positive()->setName("Displacement")->check( $params['disp'] );
         $this->displacement = $params['disp'];
         
         return $this;
     }
     
     public function calculateSLRatio(){
         return ( $this->buttockangle * -0.2 ) + 2.9;
     }
     
     public function calculateCW(){
         return round(0.8 + (0.17 * $this->calculateSLRatio()), 2);
     }
     
     public function calculateTheoreticalHullSpeed(){
         return round($this->calculateSLRatio() * sqrt( $this->hull_length ), 2);
     }
     
     public function calculateHorsePower( $speed ){
         // I could be checking a zero value on the division to prevent errors
         $formula_sub = pow($speed / ( $this->calculateCW() * sqrt( $this->hull_length ) ), 3);
        
         return round( ($this->displacement/1000) * $formula_sub, 2 );
     }
     
     public function getHullLength(){
         return $this->hull_length;
     }
     
     public function getButtockAngle(){
         return $this->buttockangle;
     }
     
     public function getDisplacement(){
         return $this->displacement;
     }
}