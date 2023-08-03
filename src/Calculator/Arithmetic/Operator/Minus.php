<?php

namespace App\Calculator\Arithmetic\Operator;

class Minus extends ArithmeticOperatorAbstract
{
    function getSign(): string
    {
        return '-';
    }
}