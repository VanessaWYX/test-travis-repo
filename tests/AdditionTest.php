<?php
class AdditionTest extends \PHPUnit\Framework\TestCase
{
    public function testAdd(){
        $calculate = new \calc\calculator; 
        $result = $calculate->add(5, 10);

        $this->assertEquals(15, $result);
    }
}