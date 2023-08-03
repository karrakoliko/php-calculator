<?php

namespace App\Calculator\Arithmetic\Operator;

use App\Calculator\Operator\OperatorInterface;

class Multiply extends ArithmeticOperatorAbstract
{

    public function resolveOperationClassName(): string
    {
        return \App\Calculator\Arithmetic\Operation\Multiply::class;
    }

    function getSign(): string
    {
        return '*';
    }
}