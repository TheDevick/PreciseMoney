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
    public function add(string $amount): self
    {
        $this->amount = $this->calculator->add($this->amount, $amount);

        return $this;
    }

    /**
     * @param numeric-string $amount
     */
    public function sub(string $amount): self
    {
        $this->amount = $this->calculator->sub($this->amount, $amount);

        return $this;
    }

    /**
     * @param numeric-string $amount
     */
    public function mul(string $amount): self
    {
        $this->amount = $this->calculator->mul($this->amount, $amount);

        return $this;
    }

    /**
     * @param numeric-string $amount
     */
    public function div(string $amount): self
    {
        $this->amount = $this->calculator->div($this->amount, $amount);

        return $this;
    }

    public function addMoney(Money $money): self
    {
        $this->amount = $this->calculator->add($this->amount, $money->amount);

        return $this;
    }

    public function subMoney(Money $money): self
    {
        $this->amount = $this->calculator->sub($this->amount, $money->amount);

        return $this;
    }

    public function mulMoney(Money $money): self
    {
        $this->amount = $this->calculator->mul($this->amount, $money->amount);

        return $this;
    }

    public function divMoney(Money $money): self
    {
        $this->amount = $this->calculator->div($this->amount, $money->amount);

        return $this;
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
