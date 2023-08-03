<?php

namespace App\Tests\Unit\Calculator\Expression;

use App\Calculator\Arithmetic\NumberOperand;
use App\Calculator\Arithmetic\Operation\Sum;
use App\Calculator\Expression\Exception\UnableToBuildExpression;
use App\Number\Number;
use PHPUnit\Framework\TestCase;

class ArithmeticExpressionTest extends TestCase
{

    public function testGetAsStringThrowsIfLessThanTwoOperands()
    {
        $this->expectException(UnableToBuildExpression::class);

        $sum = new Sum();

        $operation = $sum(new NumberOperand(Number::createFromString(5)));

        $operation->toExpression();

    }

    public function testGetAsString()
    {
        $sum = new Sum();

        $operation = $sum(
            new NumberOperand(Number::createFromString(5)),
            new NumberOperand(Number::createFromString(6))
        );

        $this->assertEquals('5 + 6', $operation->toExpression());
    }
}
