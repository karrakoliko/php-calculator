<?php

namespace App\Calculator\Arithmetic\Operation;

use App\Calculator\Arithmetic\NumberOperand;
use App\Calculator\Arithmetic\Operation\Exception\DivisionByZeroException;
use App\Calculator\Arithmetic\Operation\Exception\NoOperandsGivenException;
use App\Calculator\Arithmetic\Operator\Division;
use App\Calculator\Arithmetic\Result\CalculationResult;
use App\Calculator\Operand\OperandInterface;
use App\Calculator\Operator\OperatorInterface;
use App\Calculator\Result\ResultInterface;
use App\Number\Number;

class Divide extends ArithmeticOperationAbstract
{
    const SHORTCUT_DIVIDE_ZERO_TO_ANY_IS_ZERO = 'divide_zero_to_any_is_zero';
    const NAME = 'divide';

    private array $shortcutsUsed = [];

    /**
     * @return ResultInterface
     * @throws NoOperandsGivenException
     */
    public function exec(): ResultInterface
    {

        $this->throwIfNoOperandsGiven();

        if ($this->isDividingZero()) {
            $this->shortcutsUsed[] = self::SHORTCUT_DIVIDE_ZERO_TO_ANY_IS_ZERO;

            return new CalculationResult($this, Number::zero());
        }

        $numbers = array_map(function (NumberOperand $operand) {

            return $operand->getValue()->getValue();

        }, $this->operands);

        $initial = array_shift($numbers);

        $result = array_reduce($numbers, function ($carry, $item) {

            return $carry / $item;

        }, $initial);

        $number = Number::createFromString($result);

        return new CalculationResult($this, $number);
    }

    /**
     * @return bool
     */
    protected function isDividingZero(): bool
    {
        return $this->operands[array_key_first($this->operands)]->getValue()->equals(Number::zero());
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

    public function getName(): string
    {
        return self::NAME;
    }

    public function getOperator(): OperatorInterface
    {
        return new Division();
    }
}