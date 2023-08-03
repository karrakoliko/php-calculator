<?php

namespace App\Tests\Unit\Calculator\Arithmetic\Result;

use App\Calculator\Arithmetic\NumberOperand;
use App\Calculator\Arithmetic\Operation\Sum;
use PHPUnit\Framework\TestCase;

class CalculationResultTest extends TestCase
{

    public function testToExpression()
    {
        $op1 = NumberOperand::createFromString(2);
        $op2 = NumberOperand::createFromString(1);

        $sum = new Sum();

        $result = $sum($op1, $op2)->exec();

        $this->assertEquals('2 + 1 = 3', $result->toExpression());
    }
}
