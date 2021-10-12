<?php 
namespace calc;
class calculator
{
    function add($num1,$num2){
        return ($num1 + $num2);
    }
    function subtract($num1,$num2){
        return ($num1 - $num2);
    }
    function multiply($num1,$num2){
        return ($num1 * $num2);
    }
    function divide($num1,$num2){
        return ($num1 / $num2);
    }
    /*
    function getresult($num1, $num2, $c)
    {
        $this->num1 = $num1;
        $this->num2 = $num2;
        return $this->mainfunction($c);
    }
    */
}