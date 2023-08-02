<?php

namespace App\Calculator\Arithmetic\Operator;

use App\Calculator\Arithmetic\Operation\Sum;
use App\Calculator\Operator\OperatorInterface;

class Plus implements OperatorInterface
{

    public function resolveOperationClassName(): string
    {
        return Sum::class;
    }
}