<?php

namespace App\Calculator\Arithmetic\Operator;

use App\Calculator\Operator\OperatorInterface;

abstract class ArithmeticOperatorAbstract implements OperatorInterface
{

    abstract function getSign(): string;

    /**
     * @param ArithmeticOperatorAbstract $operator
     * @return bool
     */
    public function equals(OperatorInterface $operator): bool
    {
        return $operator->getSign() === $this->getSign();
    }

}