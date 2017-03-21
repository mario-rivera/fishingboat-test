<?php 
namespace App\Models;

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
     * We could be doing some complex validation here but for purposes of this test
     * I will simply set the potential errors to some sensible defaults.
     *
     * @param array params
     */
     public function setParametersFromRequest( array $params ){
         // could be performing validations and returing errors from HRTime\PerformanceCounter
         // I am over simplifying this method
         
         // also note that this could al very well be float values
         
         $this->hull_length = empty( intval($params['hl']) ) ? 26 : abs( intval($params['hl']) );
         
         $this->buttockangle = empty( intval($params['ba']) ) ? 2 : abs( intval($params['ba']) );
         if( $this->buttockangle < 2 || $this->buttockangle > 7 ){
             $this->buttockangle = 2;
         }
         
         $this->displacement = empty( intval($params['disp']) ) ? 10000 : abs( intval($params['disp']) );
         
         return true;
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