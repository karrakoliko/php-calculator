<?php

namespace App\Calculator\Arithmetic\Operation;

use App\Calculator\Arithmetic\NumberOperand;
use App\Calculator\Arithmetic\Operation\Exception\DivisionByZeroException;
use App\Calculator\Arithmetic\Operation\Exception\NoOperandsGivenException;
use App\Calculator\Arithmetic\Result\NumberResult;
use App\Calculator\Operand\OperandInterface;
use App\Calculator\Result\ResultInterface;
use App\Number\Number;

class Divide extends MathOperationAbstract
{
    const SHORTCUT_DIVIDE_ZERO_TO_ANY_IS_ZERO = 'divide_zero_to_any_is_zero';
    /**
     * @var NumberOperand[]
     */
    private array $operands = [];

    private array $shortcutsUsed = [];

    public function __construct()
    {

    }

    public function exec(): ResultInterface
    {

        if (!count($this->operands)) {
            throw new NoOperandsGivenException('No operands given');
        }

        if ($this->isDividingZero()) {
            $this->shortcutsUsed[] = self::SHORTCUT_DIVIDE_ZERO_TO_ANY_IS_ZERO;

            return new NumberResult(Number::zero());
        }

        $numbers = array_map(function (NumberOperand $operand) {

            return $operand->getValue()->getValue();

        }, $this->operands);

        $initial = array_shift($numbers);

        $result = array_reduce($numbers, function ($carry, $item) {

            return $carry / $item;

        }, $initial);

        $number = Number::createFromString($result);

        return new NumberResult($number);
    }

    public function getShortcutsUsed(): array
    {
        return $this->shortcutsUsed;
    }

    public function __invoke(OperandInterface ...$operands)
    {
        if ($this->isDivisionByZeroMet(...$operands)) {
            throw new DivisionByZeroException('Division by zero');
        }

        $this->operands = $operands;
        return $this;
    }

    protected function isDivisionByZeroMet(NumberOperand ...$operands): bool
    {

        $zero = Number::zero();

        $operandsCnt = count($operands);

        for ($i = 1; $i < $operandsCnt; $i++) {
            if ($operands[$i]->getValue()->equals($zero)) {
                return true;
            }
        }

        return false;
    }

    /**
     * @return bool
     */
    protected function isDividingZero(): bool
    {
        return $this->operands[array_key_first($this->operands)]->getValue()->equals(Number::zero());
    }

    public function getName(): string
    {
        return 'divide';
    }
}