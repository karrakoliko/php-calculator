<?php

namespace App\Calculator\Arithmetic\Operator;

use App\Calculator\Operator\OperatorInterface;

abstract class ArithmeticOperatorAbstract implements OperatorInterface
{

    abstract function getSign(): string;

}