<?php

namespace App\Calculator\Arithmetic;

use App\Calculator\Operand\OperandInterface;
use App\Number\Format\Validator\Exception\FormatNotSupportedException;
use App\Number\Number;
use App\Number\NumberInterface;

class NumberOperand implements OperandInterface
{
    private NumberInterface $number;

    public function __construct(NumberInterface $number)
    {
        $this->number = $number;
    }

    /**
     * @throws FormatNotSupportedException
     */
    public static function createFromString(string $value): OperandInterface
    {
        return new NumberOperand(Number::createFromString($value));
    }

    public function getValue(): NumberInterface
    {
        return $this->number;
    }
}