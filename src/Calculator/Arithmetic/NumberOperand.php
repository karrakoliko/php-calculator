<?php

namespace App\Calculator\Arithmetic;

use App\Calculator\Operand\OperandInterface;
use App\Number\NumberInterface;

class NumberOperand implements OperandInterface
{
    private NumberInterface $number;

    public function __construct(NumberInterface $number)
    {
        $this->number = $number;
    }


    public function getValue(): NumberInterface
    {
        return $this->number;
    }

    public static function createFromString(string $value): OperandInterface
    {
        // TODO: Implement createFromString() method.
    }
}