<?php

namespace App\Calculator\Arithmetic\Operator;

use App\Calculator\Arithmetic\Operation\Divide;
use App\Calculator\Operator\OperatorInterface;

class Division extends ArithmeticOperatorAbstract
{

    public function resolveOperationClassName(): string
    {
        return Divide::class;
    }

    function getSign(): string
    {
        return '/';
    }
}