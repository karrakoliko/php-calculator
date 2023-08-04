<?php

namespace App\Tests\Unit\Calculator\Arithmetic\Operation;

use App\Calculator\Arithmetic\NumberOperand;
use App\Calculator\Arithmetic\Operation\Multiply;
use App\Calculator\Operation\OperationInterface;
use PHPUnit\Framework\TestCase;

class MultiplyTest extends ArithmeticOperationTestCase
{

    public function testMultiplyToZeroIsZeroShortCutUsed()
    {
        $operands = [
            NumberOperand::createFromString('100'),
            NumberOperand::createFromString('0')
        ];

        $division = $this->getOperation();

        $division(...$operands)->exec();

        $this->assertContains(Multiply::SHORTCUT_MULTIPLY_TO_ZERO_EQUALS_ZERO, $division->getShortcutsUsed());
    }

    function getOperation(): OperationInterface
    {
        return new Multiply();
    }
}
