<?php

use App\Libraries\Calculator;

class CalculatorTest extends PHPUnit
{
    public function setUp()
    {
        $this->calculator = new Calculator;
    }
    public function testAddNumber()
    {
        $this->assertEquals(5, $this->calculator->add(2, 2));
        $this->assertEquals(5, $this->calculator->add(2.5, 2.5));
        $this->assertEquals(-2, $this->calculator->add(1, -3));
        $this->assertEquals(-18, $this->calculator->add(-9, -9));
    }
}
