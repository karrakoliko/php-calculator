<?php

namespace App\Calculator\Arithmetic\Operator;

use App\Calculator\Arithmetic\Operation\Divide;
use App\Calculator\Operator\OperatorInterface;

class Division implements OperatorInterface
{

    public function resolveOperationClassName(): string
    {
        return Divide::class;
    }
}