<?php

namespace App\Calculator\Arithmetic\Operator;

use App\Calculator\Operator\OperatorInterface;

class ArithmeticOperatorFactory
{

    public static function createBySign(string $sign): OperatorInterface
    {
        if($sign === '+'){
            return new Plus();
        }

        if($sign === '-'){
            return new Minus();
        }

        if($sign === '/'){
            return new Division();
        }

        if($sign === '*'){
            return new Multiply();
        }

        throw new \InvalidArgumentException(sprintf('Unknown sign %s', $sign));
    }

}