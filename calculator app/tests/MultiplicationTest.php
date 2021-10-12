<?php
class MultiplicationTest extends \PHPUnit\Framework\TestCase
{
    public function testMultiply(){
        $calculate = new \calc\calculator; 
        $result = $calculate->multiply(5, 10);

        $this->assertEquals(50, $result);
    }
}