<?php

namespace TheDevick\PreciseMoneyTests\TestTrait;

use TheDevick\PreciseMoney\Calculator\CalculatorInterface;

trait CalculatorTestTrait
{
    /**
     * Returns a nice message that says the Class and Scale of the Calculator. Useful with `$message` argument in assertions.
     */
    public function generateCalculatorMessage(CalculatorInterface $calculator): string
    {
        return sprintf('Calculator "%s" with scale "%s"', $calculator::class, $calculator->getScale());
    }

    /**
     * This methods asserts an calculator add method.
     *
     * @param numeric-string $expected
     * @param numeric-string $x
     * @param numeric-string $y
     */
    public function assertCalculatorAddMethod(CalculatorInterface $calculator, string $expected, string $x, string $y): void
    {
        $message = $this->generateCalculatorMessage($calculator);
        $actual = $calculator->add($x, $y);
        $scale = $calculator->getScale();
        $format = '%01.'.$scale.'f';
        $expected = sprintf($format, $expected);
        $message .= sprintf(' | %s + %s expected %s, but %s was returned', $x, $y, $expected, $actual);

        $this->assertSame($expected, $actual, $message);
    }

    /**
     * This methods asserts many operations with the calculator.
     *
     * @psalm-suppress InvalidArgument
     */
    public function assertCalculatorAddMethodComplete(CalculatorInterface $calculator): void
    {
        $this->assertCalculatorAddMethod($calculator, '12', '5', '7');
        $this->assertCalculatorAddMethod($calculator, '0', '0', '0');
        $this->assertCalculatorAddMethod($calculator, '3', '1', '2');
        $this->assertCalculatorAddMethod($calculator, '15', '10', '5');
        $this->assertCalculatorAddMethod($calculator, '-5', '-10', '5');
        $this->assertCalculatorAddMethod($calculator, '1000000000', '999999999', '1');
        $this->assertCalculatorAddMethod($calculator, '20000000000000000000', '10000000000000000000', '10000000000000000000');
        $this->assertCalculatorAddMethod($calculator, '1.5', '0.5', '1');
        $this->assertCalculatorAddMethod($calculator, '-12', '-5', '-7');
        $this->assertCalculatorAddMethod($calculator, '-2', '1', '-3');
        $this->assertCalculatorAddMethod($calculator, '-5', '0', '-5');
        $this->assertCalculatorAddMethod($calculator, '1.01', '0.5', '0.51');
        $this->assertCalculatorAddMethod($calculator, '2.334', '1.22', '1.114');
        $this->assertCalculatorAddMethod($calculator, '1.11', '0.5', '0.61');
        $this->assertCalculatorAddMethod($calculator, '3.5', '1.25', '2.25');

        $this->expectException(\ValueError::class);
        $calculator->add('5', 'abc');
        $calculator->add('abc', 'abc');
        $calculator->add('abc', '5');
    }
}
