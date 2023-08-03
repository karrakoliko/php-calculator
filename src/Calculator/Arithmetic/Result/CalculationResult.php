<?php

namespace App\Calculator\Arithmetic\Result;

use App\Calculator\Arithmetic\Expression\ArithmeticExpression;
use App\Calculator\Arithmetic\Expression\EqualityExpression;
use App\Calculator\Expression\ExpressionInterface;
use App\Calculator\Operation\OperationInterface;
use App\Calculator\Result\ResultInterface;
use App\Number\NumberInterface;

class CalculationResult implements ResultInterface
{

    private NumberInterface $resultNumber;
    private OperationInterface $operation;

    public function __construct(OperationInterface $operation, NumberInterface $resultNumber)
    {
        $this->resultNumber = $resultNumber;
        $this->operation = $operation;
    }

    public function getValue(): NumberInterface
    {
        return $this->resultNumber;
    }

    public function getOperation(): OperationInterface
    {
        return $this->operation;
    }

    public function toExpression(): ExpressionInterface
    {
        $expr = new EqualityExpression(
            $this->operation->toExpression(),
            ArithmeticExpression::fromNumber($this->resultNumber)
        );

        return $expr;
    }
}