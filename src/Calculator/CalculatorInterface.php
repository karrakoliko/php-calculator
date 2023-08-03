<?php

namespace App\Calculator;

use App\Calculator\Exception\InvalidOperandTypeException;
use App\Calculator\Operand\OperandInterface;
use App\Calculator\Operation\OperationInterface;
use App\Calculator\Operator\OperatorInterface;
use App\Calculator\Result\ResultInterface;

interface CalculatorInterface
{

    /**
     * @param OperandInterface $left
     * @param OperatorInterface $operator
     * @param OperandInterface $right
     * @return ResultInterface
     * @throws InvalidOperandTypeException
     */
    public function calculate(
        OperandInterface  $left,
        OperatorInterface $operator,
        OperandInterface  $right
    ): ResultInterface;

    /**
     * @return OperationInterface[]
     */
    public function getOperationsSupported(): array;
}