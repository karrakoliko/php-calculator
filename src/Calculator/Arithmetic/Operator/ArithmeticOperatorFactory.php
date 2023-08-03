<?php

namespace App\Calculator\Arithmetic\Operator;

use App\Calculator\Arithmetic\Operation\Divide as DivideOperation;
use App\Calculator\Arithmetic\Operation\Subtract as SubtractOperation;
use App\Calculator\Arithmetic\Operation\Sum as SumOperation;
use App\Calculator\Arithmetic\Operation\Multiply as MultiplyOperation;
use App\Calculator\Operator\OperatorInterface;
use InvalidArgumentException;

class ArithmeticOperatorFactory
{

    public static function createByOperationName(string $name): OperatorInterface
    {
        if ($name === SumOperation::NAME) {
            return new Plus();
        }

        if ($name === SubtractOperation::NAME) {
            return new Minus();
        }

        if ($name === DivideOperation::NAME) {
            return new Division();
        }

        if ($name === MultiplyOperation::NAME) {
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