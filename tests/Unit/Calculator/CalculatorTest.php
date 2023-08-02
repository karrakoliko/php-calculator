<?php

namespace App\Tests\Unit\Calculator;

use App\Calculator\Arithmetic\NumberOperand;
use App\Calculator\Arithmetic\Operator\ArithmeticOperatorFactory;
use App\Number\Number;
use App\Tests\Unit\Calculator\helpers\NumberCalculatorFactory;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{
    /**
     * @dataProvider calcResultProvider
     * @return void
     */
    public function testCalculateTwoNumbersReturnsCorrectResult($leftString, $operatorSign, $rightString, $resultString)
    {
        $calc = NumberCalculatorFactory::creatArithmetic();

        $left = new NumberOperand(Number::createFromString($leftString));
        $right = new NumberOperand(Number::createFromString($rightString));

        $operator = ArithmeticOperatorFactory::createBySign($operatorSign);

        $resultExpected = Number::createFromString($resultString);
        $resultActual = $calc->calculate($left, $operator, $right)->getValue();

        $this->assertTrue(
            $resultActual->equals($resultExpected),
            sprintf('Expected %s, given %s', $resultExpected, $resultActual)
        );

    }

    public function calcResultProvider()
    {
        $precision = ini_get('precision');

        return [
            '2+2' => ['2', '+', '2', '4'],
            '2-2' => ['2', '-', '2', '0'],
            '2/2' => ['2', '/', '2', '1'],
            '2*2' => ['2', '*', '2', '4'],
            // +1 is a '.' symbol
            '100/3' => ['100', '/', '3', str_pad('33.', $precision + 1, '3')],
        ];
    }

}
