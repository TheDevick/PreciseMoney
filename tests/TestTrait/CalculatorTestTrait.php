<?php

namespace TheDevick\PreciseMoneyTests\TestTrait;

use TheDevick\PreciseMoney\Calculator\CalculatorInterface;
use TheDevick\PreciseMoney\Money;

trait CalculatorTestTrait
{
    /**
     * Returns a nice message that says the Class and Scale of the Calculator. Useful with `$message` argument in assertions.
     *
     * @param numeric-string $expected
     */
    public function generateCalculatorMessage(CalculatorInterface $calculator, string $operation, string $x, string $y, string $expected, string $actual): string
    {
        $scale = $calculator->getScale();

        return sprintf('Calculator "%s" with scale "%s" | (%s) %s (%s) expected %s, but %s was returned', $calculator::class, $scale, $x, $operation, $y, $expected, $actual);
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
        $actual = $calculator->add($x, $y);
        $expected = Money::fixNumericString($expected, $calculator->getScale());
        $message = $this->generateCalculatorMessage($calculator, '+', $x, $y, $expected, $actual);

        $this->assertSame($expected, $actual, $message);
    }

    /**
     * This methods asserts many add operations with the calculator.
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
    }

    /**
     * This methods asserts an calculator sub method.
     *
     * @param numeric-string $expected
     * @param numeric-string $x
     * @param numeric-string $y
     */
    public function assertCalculatorSubMethod(CalculatorInterface $calculator, string $expected, string $x, string $y): void
    {
        $actual = $calculator->sub($x, $y);
        $expected = Money::fixNumericString($expected, $calculator->getScale());
        $message = $this->generateCalculatorMessage($calculator, '-', $x, $y, $expected, $actual);

        $this->assertSame($expected, $actual, $message);
    }

    /**
     * This methods asserts many sub operations with the calculator.
     *
     * @psalm-suppress InvalidArgument
     */
    public function assertCalculatorSubMethodComplete(CalculatorInterface $calculator): void
    {
        $this->assertCalculatorSubMethod($calculator, '-2', '5', '7');
        $this->assertCalculatorSubMethod($calculator, '0', '0', '0');
        $this->assertCalculatorSubMethod($calculator, '-1', '1', '2');
        $this->assertCalculatorSubMethod($calculator, '5', '10', '5');
        $this->assertCalculatorSubMethod($calculator, '-15', '-10', '5');
        $this->assertCalculatorSubMethod($calculator, '999999998', '999999999', '1');
        $this->assertCalculatorSubMethod($calculator, '0', '10000000000000000000', '10000000000000000000');
        $this->assertCalculatorSubMethod($calculator, '-0.5', '0.5', '1');
        $this->assertCalculatorSubMethod($calculator, '2', '-5', '-7');
        $this->assertCalculatorSubMethod($calculator, '4', '1', '-3');
        $this->assertCalculatorSubMethod($calculator, '5', '0', '-5');
        $this->assertCalculatorSubMethod($calculator, '-0.01', '0.5', '0.51');
        $this->assertCalculatorSubMethod($calculator, '0.106', '1.22', '1.114');
        $this->assertCalculatorSubMethod($calculator, '-0.11', '0.5', '0.61');
        $this->assertCalculatorSubMethod($calculator, '-1', '1.25', '2.25');
    }

    /**
     * This methods asserts an calculator mul method.
     *
     * @param numeric-string $expected
     * @param numeric-string $x
     * @param numeric-string $y
     */
    public function assertCalculatorMulMethod(CalculatorInterface $calculator, string $expected, string $x, string $y): void
    {
        $actual = $calculator->mul($x, $y);
        $expected = Money::fixNumericString($expected, $calculator->getScale());
        $message = $this->generateCalculatorMessage($calculator, '*', $x, $y, $expected, $actual);

        $this->assertSame($expected, $actual, $message);
    }

    /**
     * This methods asserts many mul operations with the calculator.
     *
     * @psalm-suppress InvalidArgument
     */
    public function assertCalculatorMulMethodComplete(CalculatorInterface $calculator): void
    {
        $this->assertCalculatorMulMethod($calculator, '35', '5', '7');
        $this->assertCalculatorMulMethod($calculator, '0', '0', '0');
        $this->assertCalculatorMulMethod($calculator, '2', '1', '2');
        $this->assertCalculatorMulMethod($calculator, '50', '10', '5');
        $this->assertCalculatorMulMethod($calculator, '-50', '-10', '5');
        $this->assertCalculatorMulMethod($calculator, '999999999', '999999999', '1');
        $this->assertCalculatorMulMethod($calculator, '0.5', '0.5', '1');
        $this->assertCalculatorMulMethod($calculator, '35', '-5', '-7');
        $this->assertCalculatorMulMethod($calculator, '-3', '1', '-3');
        $this->assertCalculatorMulMethod($calculator, '0', '0', '-5');
        $this->assertCalculatorMulMethod($calculator, '0.255', '0.5', '0.51');
        $this->assertCalculatorMulMethod($calculator, '1.35908', '1.22', '1.114');
        $this->assertCalculatorMulMethod($calculator, '0.305', '0.5', '0.61');
        $this->assertCalculatorMulMethod($calculator, '2.8125', '1.25', '2.25');
    }

    /**
     * This methods asserts an calculator div method.
     *
     * @param numeric-string $expected
     * @param numeric-string $x
     * @param numeric-string $y
     */
    public function assertCalculatorDivMethod(CalculatorInterface $calculator, string $expected, string $x, string $y): void
    {
        $actual = $calculator->div($x, $y);
        $expected = Money::fixNumericString($expected, $calculator->getScale());
        $message = $this->generateCalculatorMessage($calculator, '/', $x, $y, $expected, $actual);

        $this->assertSame($expected, $actual, $message);
    }

    /**
     * This methods asserts many div operations with the calculator.
     *
     * @psalm-suppress InvalidArgument
     */
    public function assertCalculatorDivMethodComplete(CalculatorInterface $calculator): void
    {
        $this->assertCalculatorDivMethod($calculator, '5', '10', '2');
        $this->assertCalculatorDivMethod($calculator, '1.5', '3', '2');
        $this->assertCalculatorDivMethod($calculator, '-2.5', '-5', '2');
        $this->assertCalculatorDivMethod($calculator, '0.3', '-3', '-10');

        $this->expectException(\DivisionByZeroError::class);
        $this->assertCalculatorDivMethod($calculator, '0', '10', '0');
    }
}
