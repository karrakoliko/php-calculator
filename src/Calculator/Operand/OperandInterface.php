<?php

namespace App\Calculator\Operand;

interface OperandInterface
{

    public function getValue();

    public static function createFromString(string $value): OperandInterface;

}