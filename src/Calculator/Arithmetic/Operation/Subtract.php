<?php

namespace App\Calculator\Arithmetic\Operation;

use App\Calculator\Arithmetic\NumberOperand;
use App\Calculator\Arithmetic\Operation\Exception\NoOperandsGivenException;
use App\Calculator\Arithmetic\Operator\Minus;
use App\Calculator\Arithmetic\Result\CalculationResult;
use App\Calculator\Operand\OperandInterface;
use App\Calculator\Operator\OperatorInterface;
use App\Calculator\Result\ResultInterface;
use App\Number\Format\Validator\Exception\FormatNotSupportedException;
use App\Number\Number;

class Subtract extends ArithmeticOperationAbstract
{

    const NAME = 'subtract';

    public function __invoke(OperandInterface ...$operands): static
    {
        $this->operands = $operands;
        return $this;
    }

    /**
     * @throws NoOperandsGivenException
     * @throws FormatNotSupportedException
     */
    public function exec(): ResultInterface
    {
        $this->throwIfNoOperandsGiven();

        $numbers = array_map(function (NumberOperand $operand) {

            return $operand->getValue()->getValue();

        }, $this->operands);

        $initial = array_shift($numbers);

        $result = array_reduce($numbers, function ($carry, $item) {

            return $carry - $item;

        }, $initial);

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
        return new Minus();
    }
}