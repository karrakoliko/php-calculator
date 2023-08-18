<?php

namespace App\Calculator\Arithmetic;

use App\Calculator\CalculatorInterface;
use App\Calculator\Exception\InvalidOperandTypeException;
use App\Calculator\Exception\OperationNotSupported;
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

    /**
     * @param OperandInterface $left
     * @param OperatorInterface $operator
     * @param OperandInterface $right
     * @return ResultInterface
     * @throws InvalidOperandTypeException
     * @throws OperationNotSupported
     */
    public function calculate(OperandInterface $left, OperatorInterface $operator, OperandInterface $right): ResultInterface
    {

        /**
         * @noinspection PhpConditionAlreadyCheckedInspection
         * We violate LSP consciously, as ArithmeticCalculator expects ONLY NumberOperand instances.
         */
        if (!$left instanceof NumberOperand || !$right instanceof NumberOperand) {
            throw new InvalidOperandTypeException('Number calculator demands NumberOperand\'s');
        }


        $operation = $this->resolveOperation($operator);
        return $operation($left, $right)->exec();

    }

    /**
     * @throws OperationNotSupported
     */
    protected function resolveOperation(OperatorInterface $operator): OperationInterface
    {
        foreach ($this->operationsSupported as $operation) {
            if ($operation->getOperator()->equals($operator)) {
                return new $operation;
            }
        }

        throw new OperationNotSupported('Operation %s is not supported');

    }

    public function getOperationsSupported(): array
    {
        return $this->operationsSupported;
    }
}