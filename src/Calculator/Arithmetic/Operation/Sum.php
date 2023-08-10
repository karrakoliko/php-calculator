<?php

namespace App\Calculator\Arithmetic\Operation;

use App\Calculator\Arithmetic\NumberOperand;
use App\Calculator\Arithmetic\Operator\Plus;
use App\Calculator\Arithmetic\Result\CalculationResult;
use App\Calculator\Operand\OperandInterface;
use App\Calculator\Operator\OperatorInterface;
use App\Calculator\Result\ResultInterface;
use App\Number\Number;

class Sum extends ArithmeticOperationAbstract
{

    const NAME = 'sum';

    public function __invoke(OperandInterface ...$operands)
    {
        $this->operands = $operands;
        return $this;
    }

    public function exec(): ResultInterface
    {
        $this->throwIfNoOperandsGiven();

        $numbers = array_map(function (NumberOperand $operand) {

            return $operand->getValue()->getValue();

        }, $this->operands);

        $result = array_sum($numbers);

        return new CalculationResult($this, Number::createFromFloat($result));
    }

    public function getShortcutsUsed(): array
    {
        return [];
    }

    public function getName(): string
    {
        return self::NAME;
    }

    public function getOperator(): OperatorInterface
    {
        return new Plus();
    }
}