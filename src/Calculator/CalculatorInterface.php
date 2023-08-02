<?php

namespace App\Calculator;

use App\Calculator\Exception\InvalidOperandTypeException;
use App\Calculator\Operand\OperandInterface;
use App\Calculator\Operator\OperatorInterface;
use App\Calculator\Result\ResultInterface;

interface CalculatorInterface
{

    /**
     * @param OperandInterface $left
     * @param OperatorInterface $operator
     * @param OperandInterface $right
     * @throws InvalidOperandTypeException
     * @return ResultInterface
     */
    public function calculate(
        OperandInterface $left,
        OperatorInterface $operator,
        OperandInterface $right
    ): ResultInterface;

}