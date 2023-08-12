<?php

namespace TheDevick\PreciseMoneyTests\Unit\Money;

use PHPUnit\Framework\TestCase;
use TheDevick\PreciseMoney\Calculator\BCMathCalculator;
use TheDevick\PreciseMoney\Money;

class MoneyTest extends TestCase
{
    /**
     * @psalm-suppress InvalidArgument
     */
    public function testCalculationMethodsWithNonNumericAmount(): void
    {
        $this->expectException(\ValueError::class);
        $money = new Money('10.5');

        $money->add('abc');
        $money->add('3e2');
        $money->add('3E2');

        $money->sub('abc');
        $money->sub('3e2');
        $money->sub('3E2');

        $money->mul('abc');
        $money->mul('3e2');
        $money->mul('3E2');

        $money->div('abc');
        $money->div('3e2');
        $money->div('3E2');
    }

    public function testCalculationMethods(): void
    {
        $money = new Money('10.50', new BCMathCalculator(2));

        $this->assertSame('10.80', $money->add('0.30')->getAmount());
        $this->assertSame('7.70', $money->sub('2.80')->getAmount());
        $this->assertSame('2.62', $money->div('4.00')->getAmount());
        $this->assertSame('5.25', $money->mul('0.50')->getAmount());
        $this->assertSame('31.50', $money->mul('3.00')->getAmount());
    }

    public function testCalculationMethodsWithMoney(): void
    {
        $money = new Money('10.50', new BCMathCalculator(2));

        $this->assertSame('10.80', $money->addMoney(new Money('0.30'))->getAmount());
        $this->assertSame('7.70', $money->subMoney(new Money('2.80'))->getAmount());
        $this->assertSame('2.62', $money->divMoney(new Money('4.00'))->getAmount());
        $this->assertSame('5.25', $money->mulMoney(new Money('0.50'))->getAmount());
        $this->assertSame('31.50', $money->mulMoney(new Money('3.00'))->getAmount());
    }

    public function testCalculationMethodsIsNotChangingAmount(): void
    {
        $money = new Money('10.5', new BCMathCalculator(1));

        $money->add('0.3');
        $this->assertSame('10.5', $money->getAmount());

        $money->sub('2.8');
        $this->assertSame('10.5', $money->getAmount());

        $money->div('2');
        $this->assertSame('10.5', $money->getAmount());

        $money->mul('0.5');
        $this->assertSame('10.5', $money->getAmount());
    }

    public function testCalculationMethodsWithMoneyIsChangingAmount(): void
    {
        $money = new Money('10.5', new BCMathCalculator(1));

        $money->addMoney(new Money('0.3'));
        $this->assertSame('10.5', $money->getAmount());

        $money->subMoney(new Money('2.8'));
        $this->assertSame('10.5', $money->getAmount());

        $money->divMoney(new Money('2'));
        $this->assertSame('10.5', $money->getAmount());

        $money->mulMoney(new Money('0.5'));
        $this->assertSame('10.5', $money->getAmount());
    }
}
