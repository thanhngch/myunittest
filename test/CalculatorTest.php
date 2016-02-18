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
        $this->assertEquals(4, $this->calculator->add(2, 2));
        $this->assertEquals(5, $this->calculator->add(2.5, 2.5));
        $this->assertEquals(-2, $this->calculator->add(1, -3));
        $this->assertEquals(-18, $this->calculator->add(-9, -9));
    }

    public function inputNumbers() 
    {
        return [
            [2,2,5],
            [2.5,2.5,5],
            [-3,1,-2],
            [-9,-9,-18]
        ];
    }

    /**
     * @dataProvider inputNumbers
     */
    public function testAddNumber2($x, $y, $sum)
    {
        $this->assertEquals($sum, $this->calculator->add($x, $y));
    }
}
