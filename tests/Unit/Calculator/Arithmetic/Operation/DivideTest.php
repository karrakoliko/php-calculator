<?php

namespace App\Tests\Unit\Calculator\Arithmetic\Operation;

use App\Calculator\Arithmetic\NumberOperand;
use App\Calculator\Arithmetic\Operation\Divide;
use App\Calculator\Arithmetic\Operation\Exception\DivisionByZeroException;
use App\Calculator\Operation\OperationInterface;
use PHPUnit\Framework\TestCase;

class DivideTest extends ArithmeticOperationTestCase
{

    public function testThrowsIfDivisionByZeroMet()
    {
        $this->expectException(DivisionByZeroException::class);

        $operands = [
            NumberOperand::createFromString('1'),
            NumberOperand::createFromString('0')
        ];

        $operation = $this->getOperation();

        $operation(...$operands)->exec();
    }

    public function testDoesNotThrowDivisionByZeroExceptionIfZeroIsFirstOperand()
    {
        $this->expectNotToPerformAssertions();

        $operands = [
            NumberOperand::createFromString('0'),
            NumberOperand::createFromString('1')
        ];

        $operation = $this->getOperation();

        $operation(...$operands)->exec();

    }

    public function testDivideZeroToAnyIsZeroShortCutUsed()
    {
        $operands = [
            NumberOperand::createFromString('0'),
            NumberOperand::createFromString('1')
        ];

        $operation = $this->getOperation();

        $operation(...$operands)->exec();

        $this->assertContains(Divide::SHORTCUT_DIVIDE_ZERO_TO_ANY_IS_ZERO, $operation->getShortcutsUsed());
    }

    /**
     * @return Divide
     */
    function getOperation(): OperationInterface
    {
        return new Divide();
    }
}
