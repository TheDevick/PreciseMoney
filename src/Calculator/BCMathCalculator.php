<?php

namespace TheDevick\PreciseMoney\Calculator;

class BCMathCalculator implements CalculatorInterface
{
    public function __construct(private int $scale = 2)
    {
    }

    public function getScale(): int
    {
        return $this->scale;
    }

    public function setScale(int $scale): self
    {
        $this->scale = $scale;

        return $this;
    }

    /**
     * @param numeric-string $x
     * @param numeric-string $y
     *
     * @return numeric-string
     */
    public function add(string $x, string $y): string
    {
        return bcadd($x, $y, $this->scale);
    }

    /**
     * @param numeric-string $x
     * @param numeric-string $y
     *
     * @return numeric-string
     */
    public function sub(string $x, string $y): string
    {
        return bcsub($x, $y, $this->scale);
    }

    /**
     * @param numeric-string $x
     * @param numeric-string $y
     *
     * @return numeric-string
     */
    public function mul(string $x, string $y): string
    {
        return bcmul($x, $y, $this->scale);
    }

    /**
     * @param numeric-string $x
     * @param numeric-string $y
     *
     * @return numeric-string
     */
    public function div(string $x, string $y): string
    {
        return bcdiv($x, $y, $this->scale);
    }
}
