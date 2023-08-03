<?php

namespace App\Calculator\Arithmetic\Operation;

use App\Calculator\Arithmetic\NumberOperand;
use App\Calculator\Arithmetic\Result\NumberResult;
use App\Calculator\Operand\OperandInterface;
use App\Calculator\Operation\OperationInterface;
use App\Calculator\Result\ResultInterface;
use App\Number\Number;

class Subtract implements OperationInterface
{
    /**
     * @var NumberOperand[]
     */
    private array $operands;

    public function __invoke(OperandInterface ...$operands)
    {
        $this->operands = $operands;
        return $this;
    }

    public function exec(): ResultInterface
    {
        $numbers = array_map(function (NumberOperand $operand) {

            return $operand->getValue()->getValue();

        }, $this->operands);

        $initial = array_shift($numbers);

        $result = array_reduce($numbers, function ($carry, $item) {

            return $carry - $item;

        }, $initial);

        return new NumberResult(Number::createFromString($result));
    }

    public function getShortcutsUsed(): array
    {
        return [];
    }
}