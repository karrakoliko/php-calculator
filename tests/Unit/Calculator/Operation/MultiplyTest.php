<?php

namespace App\Tests\Unit\Calculator\Operation;

use App\Calculator\Arithmetic\NumberOperand;
use App\Calculator\Arithmetic\Operation\Multiply;
use App\Number\Number;
use PHPUnit\Framework\TestCase;

class MultiplyTest extends TestCase
{

    public function testMultiplyToZeroIsZeroShortCutUsed()
    {
        $operands = [
            new NumberOperand(Number::createFromString('100')),
            new NumberOperand(Number::createFromString('0')),
        ];

        $division = new Multiply();

        $division(...$operands)->exec();

        $this->assertContains(Multiply::SHORTCUT_MULTIPLY_TO_ZERO_EQUALS_ZERO, $division->getShortcutsUsed());
    }

}