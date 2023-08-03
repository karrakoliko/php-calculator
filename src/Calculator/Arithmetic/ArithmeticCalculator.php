<?php

namespace App\Calculator\Arithmetic;

use App\Calculator\CalculatorInterface;
use App\Calculator\Exception\InvalidOperandTypeException;
use App\Calculator\Operand\OperandInterface;
use App\Calculator\Operation\OperationInterface;
use App\Calculator\Operator\OperatorInterface;
use App\Calculator\Result\ResultInterface;

class ArithmeticCalculator implements CalculatorInterface
{

    /**
     * @var OperationInterface[]
     */
    private array $operationsSupported;

    /**
     * @param OperationInterface[] $operationsSupported
     */
    public function __construct(array $operationsSupported)
    {
        $this->operationsSupported = $operationsSupported;
    }

    public function createOperation()
    {

    }

    public function calculate(OperandInterface $left, OperatorInterface $operator, OperandInterface $right): ResultInterface
    {

        if (!$left instanceof NumberOperand || !$right instanceof NumberOperand) {
            throw new InvalidOperandTypeException('Number calculator demands NumberOperand\'s');
        }


        $operation = $this->resolveOperation($operator);
        return $operation($left, $right)->exec();

    }

    protected function resolveOperation(OperatorInterface $operator): OperationInterface
    {
        $operation = $operator->resolveOperationClassName();
        return new $operation;

    }

}