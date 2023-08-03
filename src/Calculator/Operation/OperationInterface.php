<?php

namespace App\Calculator\Operation;

use App\Calculator\Arithmetic\NumberOperand;
use App\Calculator\Arithmetic\Operation\Exception\NoOperandsGivenException;
use App\Calculator\Operand\OperandInterface;
use App\Calculator\Result\ResultInterface;

interface OperationInterface
{
    /**
     * @throws NoOperandsGivenException
     * @return ResultInterface
     */
    public function exec(): ResultInterface;

    public function getShortcutsUsed(): array;

    public function __invoke(OperandInterface ...$operands);

    public function getName(): string;

}