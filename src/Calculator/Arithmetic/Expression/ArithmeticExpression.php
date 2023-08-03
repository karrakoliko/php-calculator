<?php

namespace App\Calculator\Arithmetic\Expression;

use App\Calculator\Expression\ExpressionInterface;
use App\Number\NumberInterface;

class ArithmeticExpression implements ExpressionInterface
{

    protected array $members;

    public static function fromNumber(NumberInterface $number): ExpressionInterface
    {
        $expression = new self();

        $expression->addMember($number->getValue());

        return $expression;
    }

    public function addMember(string $member): void
    {
        $this->members[] = $member;
    }

    public function __toString(): string
    {
        return $this->getAsString();
    }

    public function getAsString(): string
    {
        return join(' ', $this->members);
    }
}