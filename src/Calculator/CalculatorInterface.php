<?php

namespace TheDevick\PreciseMoney\Calculator;

interface CalculatorInterface
{
    public function __construct(int $scale = 2);

    public function getScale(): int;

    public function setScale(int $scale): self;

    /**
     * @param numeric-string $x
     * @param numeric-string $y
     *
     * @return numeric-string
     */
    public function add(string $x, string $y): string;

    /**
     * @param numeric-string $x
     * @param numeric-string $y
     *
     * @return numeric-string
     */
    public function sub(string $x, string $y): string;

    /**
     * @param numeric-string $x
     * @param numeric-string $y
     *
     * @return numeric-string
     */
    public function mul(string $x, string $y): string;

    /**
     * @param numeric-string $x
     * @param numeric-string $y
     *
     * @return numeric-string
     */
    public function div(string $x, string $y): string;
}
