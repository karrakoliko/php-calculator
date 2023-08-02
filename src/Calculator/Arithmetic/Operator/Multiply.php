<?php

namespace App\Calculator\Arithmetic\Operator;

use App\Calculator\Operator\OperatorInterface;

class Multiply implements OperatorInterface
{

    public function resolveOperationClassName(): string
    {
        return \App\Calculator\Arithmetic\Operation\Multiply::class;
    }
}