<?php

namespace App\Calculator\Arithmetic\Operator;

class Division extends ArithmeticOperatorAbstract
{

    function getSign(): string
    {
        return '/';
    }
}