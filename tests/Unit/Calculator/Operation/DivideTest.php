<?php

namespace App\Tests\Unit\Calculator\Operation;

use App\Calculator\Arithmetic\NumberOperand;
use App\Calculator\Arithmetic\Operation\Divide;
use App\Calculator\Arithmetic\Operation\Exception\DivisionByZeroException;
use App\Number\Number;
use PHPUnit\Framework\TestCase;

class DivideTest extends TestCase
{

    public function testThrowsIfDivisionByZeroMet()
    {
        $this->expectException(DivisionByZeroException::class);

        $operands = [
            new NumberOperand(Number::createFromString('1')),
            new NumberOperand(Number::createFromString('0'))
        ];

        $operation = new Divide();

        $operation(...$operands)->exec();
    }

    public function testDoesNotThrowDivisionByZeroExceptionIfZeroIsFirstOperand()
    {
        $this->expectNotToPerformAssertions();

        $operands = [
            new NumberOperand(Number::createFromString('0')),
            new NumberOperand(Number::createFromString('1'))
        ];

        $operation = new Divide();

        $operation(...$operands)->exec();

    }

    public function testDivideZeroToAnyIsZeroShortCutUsed()
    {
        $operands = [
            new NumberOperand(Number::createFromString('0')),
            new NumberOperand(Number::createFromString('1'))
        ];

        $operation = new Divide();

        $operation(...$operands)->exec();

        $this->assertContains(Divide::SHORTCUT_DIVIDE_ZERO_TO_ANY_IS_ZERO, $operation->getShortcutsUsed());
    }

}
