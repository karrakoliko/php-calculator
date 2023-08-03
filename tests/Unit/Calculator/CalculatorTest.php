<?php

namespace App\Tests\Unit\Calculator;

use App\Calculator\Arithmetic\ArithmeticCalculator;
use App\Calculator\Arithmetic\NumberOperand;
use App\Calculator\Arithmetic\Operation\Multiply;
use App\Calculator\Arithmetic\Operator\ArithmeticOperatorFactory;
use App\Calculator\Exception\OperationNotSupported;
use App\Number\Number;
use App\Tests\Unit\Calculator\helpers\NumberCalculatorFactory;
use PHPUnit\Framework\TestCase;

class CalculatorTest extends TestCase
{

    public function testSupportedOperationsRespected()
    {
        $this->expectException(OperationNotSupported::class);

        $operations = [new Multiply()];

        $multiplyCalc = new ArithmeticCalculator($operations);

        $left = $this->createStub(NumberOperand::class);
        $right = $this->createStub(NumberOperand::class);

        $operator = ArithmeticOperatorFactory::createBySign('-');

        $multiplyCalc->calculate($left, $operator, $right);

    }

    /**
     * @dataProvider calcResultProvider
     * @return void
     */
    public function testCalculateTwoNumbersReturnsCorrectResult($leftString, $operatorSign, $rightString, $resultString)
    {
        $calc = NumberCalculatorFactory::creatArithmetic();

        $left = NumberOperand::createFromString($leftString);
        $right = NumberOperand::createFromString($rightString);

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
