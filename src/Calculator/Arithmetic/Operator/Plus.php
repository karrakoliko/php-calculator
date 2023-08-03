<?php

namespace App\Calculator\Arithmetic\Operator;

class Plus extends ArithmeticOperatorAbstract
{

    function getSign(): string
    {
        return '+';
    }
}