<?php

namespace App\Calculator\Arithmetic\Expression;

use App\Calculator\Expression\ExpressionInterface;

class ArithmeticExpression implements ExpressionInterface
{

    protected array $members;

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