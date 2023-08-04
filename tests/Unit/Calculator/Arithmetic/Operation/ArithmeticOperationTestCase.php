<?php

namespace App\Tests\Unit\Calculator\Arithmetic\Operation;

use App\Calculator\Arithmetic\Operation\Exception\NoOperandsGivenException;
use App\Calculator\Operation\OperationInterface;
use PHPUnit\Framework\TestCase;

abstract class ArithmeticOperationTestCase extends TestCase
{

    public function testThrowsIfNoOperandsGiven()
    {

        $this->expectException(NoOperandsGivenException::class);

        $operation = $this->getOperation();

        $operandsCnt = count($operation->getOperands());

        if ($operandsCnt) {
            return $this->markTestIncomplete(
                sprintf(
                    'Unable to perform test: test demands no operands set, %s operands set', $operandsCnt
                )
            );
        }

        $operation->exec();

    }

    abstract function getOperation(): OperationInterface;

}