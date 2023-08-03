<?php

namespace App\Calculator\Arithmetic\Expression;

use App\Calculator\Expression\ExpressionInterface;

class EqualityExpression implements ExpressionInterface
{

    private ArithmeticExpression $leftPart;
    private ArithmeticExpression $rightPart;

    public function __construct(ArithmeticExpression $leftPart, ArithmeticExpression $rightPart)
    {

        $this->leftPart = $leftPart;
        $this->rightPart = $rightPart;
    }

    public function __toString(): string
    {
        return $this->getAsString();
    }

    public function getAsString(): string
    {
        return join(' ',
            [
                $this->leftPart->getAsString(),
                '=',
                $this->rightPart->getAsString()
            ]
        );

    }
}