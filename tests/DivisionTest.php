<?php
class DivisionTest extends \PHPUnit\Framework\TestCase
{
    public function testDivide(){
        $calculate = new \calc\calculator; 
        $result = $calculate->divide(50, 10);

        $this->assertEquals(5, $result);
    }
}