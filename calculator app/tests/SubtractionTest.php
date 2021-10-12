<?php
class SubtractionTest extends \PHPUnit\Framework\TestCase
{
    public function testSubtract(){
        $calculate = new \calc\calculator; 
        $result = $calculate->subtract(20, 10);

        $this->assertEquals(10, $result);
    }
}