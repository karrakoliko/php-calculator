<?php

namespace App\Calculator\Arithmetic\Operator;

use App\Calculator\Arithmetic\Operation\Subtract;
use App\Calculator\Operator\OperatorInterface;

class Minus extends ArithmeticOperatorAbstract
{

    public function resolveOperationClassName(): string
    {
        return Subtract::class;
    }

    function getSign(): string
    {
        return '-';
    }
}