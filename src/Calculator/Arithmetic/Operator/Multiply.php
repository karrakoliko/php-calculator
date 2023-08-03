<?php

namespace App\Calculator\Arithmetic\Operator;

class Multiply extends ArithmeticOperatorAbstract
{

    function getSign(): string
    {
        return '*';
    }
}