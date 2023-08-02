<?php

namespace App\Tests\Unit\Calculator\helpers;

use App\Calculator\Arithmetic\ArithmeticCalculator;
use App\Calculator\Arithmetic\Operation\Divide;
use App\Calculator\Arithmetic\Operation\Multiply;
use App\Calculator\Arithmetic\Operation\Subtract;
use App\Calculator\Arithmetic\Operation\Sum;

class NumberCalculatorFactory
{

    public static function creatArithmetic(): ArithmeticCalculator
    {

        $operations = [];

        $operations[] = new Sum();
        $operations[] = new Divide();
        $operations[] = new Subtract();
        $operations[] = new Multiply();

        return new ArithmeticCalculator($operations);
    }

}