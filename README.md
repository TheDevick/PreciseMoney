# PHP Precise Money

[![NystronSolarBadge](https://img.shields.io/badge/⚡%20Sponsored%20By-Nystron%20Solar-yellow?style=for-the-badge)](https://github.com/NystronSolar)
[![PHPUnitBadge](https://img.shields.io/badge/✓%20PHPUnit-Tests-blue?style=for-the-badge)](https://phpunit.de/)
[![PHPBadge](https://img.shields.io/badge/🐘%20PHP-8.2-steelblue?style=for-the-badge)](https://php.net/)
[![PsalmBadge](https://img.shields.io/badge/📌%20Psalm-Static%20Analysis-red?style=for-the-badge)](https://psalm.dev/)
[![SemanticReleaseBadge](https://img.shields.io/badge/semantic--release-angular-e10079?logo=semantic-release&style=for-the-badge)](https://github.com/semantic-release/semantic-release)

![Precise Money](https://github.com/TheDevick/PreciseMoney/assets/71853418/8d3d229e-c1ec-44ff-a050-2d5a46a31ca7)

## The Money Object

The Money class is a **mutable** class, that represent an amount of money. You can add, subtract, multiply and divide the amount in the object with numeric-string or other Money object. Also, the Money Class is Json Serializable and Stringable.

```php
<?php

use TheDevick\PreciseMoney\Calculator\BCMathCalculator;
use TheDevick\PreciseMoney\Money;

$money = new Money('10', new BCMathCalculator(2)); // Start with $10, using the BCMathCalculator with scale 2 (The default is using scale 10)
$money->addMoney(new Money('3')); // Add $3.00
$money->add('5.5'); // Add $5.50

return json_encode($money); // Returns {"amount":"18.50"}
```

### Internally

Internally, the Money object stores the amount in an numeric-string.

## Calculating

Today, we only have the [`BCMathCalculator`](/src/Calculator/BCMathCalculator.php) available, that implements the [`CalculatorInterface`](src/Calculator//CalculatorInterface.php).

## Tests

### Calculator

> [Custom Calculator Test Trait](/tests/TestCase/CalculatorTestCase.php)

To test calculator classes that implements the [Calculator Interface](/src/Calculator/CalculatorInterface.php), you can use the Calculator Test Trait. It have some methods that can help you write your tests:

- `generateCalculatorMessage(CalculatorInterface $calculator)` Returns a nice message that says the Class and Scale of the Calculator. Useful with `$message` argument in assertions.
- `assertCalculatorAddMethod($calculator, $expected, $x, $y)` This methods asserts the calculator add method.
- `assertCalculatorAddMethodComplete($calculator)`nThis methods asserts many operations with the calculator.
