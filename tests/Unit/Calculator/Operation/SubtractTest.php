<?php

namespace App\Tests\Unit\Calculator\Operation;

use App\Calculator\Arithmetic\NumberOperand;
use App\Calculator\Arithmetic\Operation\Exception\NoOperandsGivenException;
use App\Calculator\Arithmetic\Operation\Subtract;
use App\Number\Number;
use App\Number\NumberInterface;
use PHPUnit\Framework\TestCase;

class SubtractTest extends TestCase
{
    /**
     * @dataProvider subtractProvider
     * @param string $leftStr
     * @param string $rightStr
     * @param string $resultString
     * @return void
     * @throws NoOperandsGivenException
     */
    public function testExec(string $leftStr, string $rightStr, string $resultString)
    {

        $op1 = new NumberOperand(Number::createFromString($leftStr));
        $op2 = new NumberOperand(Number::createFromString($rightStr));

        $operation = new Subtract();

        /** @var NumberInterface $result */
        $result = $operation($op1, $op2)->exec()->getValue();

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

    public function subtractProvider(): array
    {
        return [
            '2-2=0'=>['2','2','0'],
            '1-2=-1'=>['1','2','-1'],
            '1.6-1=0.6'=>['1.6','1','0.6'],
            '1.6001-2=-0.3999'=>['1.6001','2','-0.3999'],
        ];
    }


}
