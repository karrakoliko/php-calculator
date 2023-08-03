<?php

namespace App\Calculator\Arithmetic\Operation;

use App\Calculator\Arithmetic\NumberOperand;
use App\Calculator\Arithmetic\Result\NumberResult;
use App\Calculator\Operand\OperandInterface;
use App\Calculator\Operation\OperationInterface;
use App\Calculator\Result\ResultInterface;
use App\Number\Number;

class Multiply implements OperationInterface
{
    /**
     * @var NumberOperand[]
     */
    private array $operands;

    const SHORTCUT_MULTIPLY_TO_ZERO_EQUALS_ZERO = 'shortcut_multiply_to_zero_equals_zero';
    private array $shortcutsUsed = [];

    public function exec(): ResultInterface
    {
        if($this->hasZeroOperand()){
            $this->shortcutsUsed[] = self::SHORTCUT_MULTIPLY_TO_ZERO_EQUALS_ZERO;
            return new NumberResult(Number::zero());
        }

        $numbers = array_map(function (NumberOperand $operand) {
            return $operand->getValue()->getValue();
        }, $this->operands);

        $initial = array_shift($numbers);

        $result = array_reduce($numbers, function ($carry, $item) {
            return $carry * $item;
        }, $initial);

        return new NumberResult(Number::createFromString($result));
    }

    public function getShortcutsUsed(): array
    {
        return $this->shortcutsUsed;
    }

    /**
     * @return bool
     */
    protected function hasZeroOperand(): bool
    {
        $hasZeroOperand = false;

        foreach ($this->operands as $operand) {

            if ($operand->getValue()->equals(Number::zero())) {
                $hasZeroOperand = true;
                break;
            }
        }

        return $hasZeroOperand;
    }

    public function __invoke(OperandInterface ...$operands)
    {
        $this->operands = $operands;
        return $this;
    }

    public function getName(): string
    {
        return 'multiply';
    }
}