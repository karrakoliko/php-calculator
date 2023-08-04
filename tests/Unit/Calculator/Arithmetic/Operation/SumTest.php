<?php

namespace App\Tests\Unit\Calculator\Arithmetic\Operation;

use App\Calculator\Arithmetic\NumberOperand;
use App\Calculator\Arithmetic\Operation\Sum;
use App\Calculator\Operation\OperationInterface;
use App\Number\Number;
use App\Number\NumberInterface;
use PHPUnit\Framework\TestCase;

class SumTest extends ArithmeticOperationTestCase
{
    /**
     * @dataProvider sumProvider
     * @param string $leftStr
     * @param string $rightStr
     * @param string $resultString
     * @return void
     */
    public function testExec(string $leftStr, string $rightStr, string $resultString)
    {

        $op1 = NumberOperand::createFromString($leftStr);
        $op2 = NumberOperand::createFromString($rightStr);

        $sum = $this->getOperation();

        /** @var NumberInterface $result */
        $result = $sum($op1, $op2)->exec()->getValue();

        $expected = Number::createFromString($resultString);
        $this->assertTrue(
            $result->equals($expected),
            sprintf(
                'Expected %s, %s given',
                $expected->getValue(),
                $result->getValue()
            )
        );

    }

    public function sumProvider()
    {
        return [
            '2+3=5' => [
                '2', '3', '5'
            ],
            '2+(-3)=-1' => [
                '2', '-3', '-1'
            ],
            '2.1+3=5.1' => [
                '2.1', '3', '5.1'
            ],
            '2.1+(-3)=-1.1' => [
                '2.1', '-3', '-0.9'
            ]
        ];
    }

    /**
     * @return Sum
     */
    function getOperation(): OperationInterface
    {
        return new Sum();
    }
}
