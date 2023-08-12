<?php

namespace TheDevick\PreciseMoneyTests\Unit\Calculator;

use PHPUnit\Framework\TestCase;
use TheDevick\PreciseMoney\Calculator\BCMathCalculator;
use TheDevick\PreciseMoneyTests\TestTrait\CalculatorTestTrait;

class BCMathCalculatorTest extends TestCase
{
    use CalculatorTestTrait;

    public function testAddWithScale1(): void
    {
        $this->assertCalculatorAddMethodComplete(new BCMathCalculator(1));
        $this->assertCalculatorAddMethodComplete(new BCMathCalculator(2));
        $this->assertCalculatorAddMethodComplete(new BCMathCalculator(3));
    }
}
