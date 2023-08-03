<?php

namespace App\Tests\Unit\Calculator\Arithmetic\Expression;

use App\Calculator\Arithmetic\Expression\ArithmeticExpression;
use App\Calculator\Arithmetic\Expression\EqualityExpression;
use PHPUnit\Framework\TestCase;

class EqualityExpressionTest extends TestCase
{

    public function testGetAsString()
    {

        $expr1 = $this->createStub(ArithmeticExpression::class);
        $expr1->method('getAsString')->willReturn('7 * 5');
        
        $expr2 = $this->createStub(ArithmeticExpression::class);
        $expr2->method('getAsString')->willReturn('35');

        $equalityExpr = new EqualityExpression($expr1,$expr2);

        $this->assertEquals('7 * 5 = 35', $equalityExpr->getAsString());

    }
}
