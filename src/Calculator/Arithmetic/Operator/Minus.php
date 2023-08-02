<?php

namespace App\Calculator\Arithmetic\Operator;

use App\Calculator\Arithmetic\Operation\Subtract;
use App\Calculator\Operator\OperatorInterface;

class Minus implements OperatorInterface
{

    public function resolveOperationClassName(): string
    {
        return Subtract::class;
    }
}