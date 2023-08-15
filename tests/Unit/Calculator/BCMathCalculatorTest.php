<?php

namespace TheDevick\PreciseMoneyTests\Unit\Calculator;

use PHPUnit\Framework\TestCase;
use TheDevick\PreciseMoney\Calculator\BCMathCalculator;
use TheDevick\PreciseMoneyTests\TestTrait\CalculatorTestTrait;

class BCMathCalculatorTest extends TestCase
{
    use CalculatorTestTrait;

    public function testCalculationMethods(): void
    {
        $this->assertCalculatorAddMethodComplete(new BCMathCalculator(5));
        $this->assertCalculatorSubMethodComplete(new BCMathCalculator(5));
        $this->assertCalculatorMulMethodComplete(new BCMathCalculator(5));
        $this->assertCalculatorDivMethodComplete(new BCMathCalculator(5));
    }
}
