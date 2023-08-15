<?php

namespace TheDevick\PreciseMoney;

use TheDevick\PreciseMoney\Calculator\BCMathCalculator;
use TheDevick\PreciseMoney\Calculator\CalculatorInterface;

class Money implements \JsonSerializable, \Stringable
{
    /**
     * @param numeric-string $amount
     */
    public function __construct(private string $amount, public readonly CalculatorInterface $calculator = new BCMathCalculator(10))
    {
    }

    /**
     * @return numeric-string
     */
    public function getAmount(): string
    {
        return $this->amount;
    }

    /**
     * @param numeric-string $amount
     */
    public function add(string $amount): Money
    {
        return new Money($this->calculator->add($this->amount, $amount), $this->calculator);
    }

    /**
     * @param numeric-string $amount
     */
    public function sub(string $amount): Money
    {
        return new Money($this->calculator->sub($this->amount, $amount), $this->calculator);
    }

    /**
     * @param numeric-string $amount
     */
    public function mul(string $amount): Money
    {
        return new Money($this->calculator->mul($this->amount, $amount), $this->calculator);
    }

    /**
     * @param numeric-string $amount
     */
    public function div(string $amount): Money
    {
        return new Money($this->calculator->div($this->amount, $amount), $this->calculator);
    }

    public function addMoney(Money $money): Money
    {
        return $this->add($money->getAmount());
    }

    public function subMoney(Money $money): Money
    {
        return $this->sub($money->getAmount());
    }

    public function mulMoney(Money $money): Money
    {
        return $this->mul($money->getAmount());
    }

    public function divMoney(Money $money): Money
    {
        return $this->div($money->getAmount());
    }

    /**
     * Fix the current amount and return a new Money object. Example: "10.235" with 2 decimals -> "10.23"
     *
     * @param integer $decimals
     * 
     * @return Money
     */
    public function fix(int $decimals): Money
    {
        return new Money($this->fixToNumericString($decimals), $this->calculator);
    }

    /**
     * Fix the current amount and return the numeric string. Example: "10.235" with 2 decimals -> "10.23"
     * 
     * @return numeric-string
     */
    public function fixToNumericString(int $decimals): string
    {
        return static::fixNumericString($this->getAmount(), $decimals);
    }

    /**
     * Fix the amount and return the numeric string. Example: "10.235" with 2 decimals -> "10.23"
     * 
     * @param numeric-string $amount
     *
     * @return numeric-string
     */
    public static function fixNumericString(string $amount, int $decimals): string
    {
        $value = sprintf('%0.'.$decimals.'f', $amount);

        // Remove the "+" or "-" sign if the number is zero
        if ('-0' === $value || '+0' === $value) {
            $value = substr($value, 1);
        }

        /** @var numeric-string $value */
        return $value;
    }

    /**
     * @return array{amount: numeric-string}
     */
    public function jsonSerialize(): array
    {
        return ['amount' => $this->amount];
    }

    /**
     * @return numeric-string
     */
    public function __toString(): string
    {
        return $this->amount;
    }
}
