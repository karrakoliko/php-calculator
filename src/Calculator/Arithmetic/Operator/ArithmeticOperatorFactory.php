<?php

namespace App\Calculator\Arithmetic\Operator;

use App\Calculator\Operator\OperatorInterface;
use InvalidArgumentException;

class ArithmeticOperatorFactory
{

    public static function createByName(string $name): OperatorInterface
    {
        if ($name === 'plus') {
            return new Plus();
        }

        if ($name === 'minus') {
            return new Minus();
        }

        if ($name === 'divide') {
            return new Division();
        }

        if ($name === 'multiply') {
            return new Multiply();
        }

        throw new InvalidArgumentException(sprintf('Unknown operator name %s', $name));
    }

    public static function createBySign(string $sign): OperatorInterface
    {
        if ($sign === '+') {
            return new Plus();
        }

        if ($sign === '-') {
            return new Minus();
        }

        if ($sign === '/') {
            return new Division();
        }

        if ($sign === '*') {
            return new Multiply();
        }

        throw new InvalidArgumentException(sprintf('Unknown sign %s', $sign));
    }

}