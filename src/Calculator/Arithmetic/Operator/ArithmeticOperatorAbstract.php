<?php

namespace App\Calculator\Arithmetic\Operator;

use App\Calculator\Operator\OperatorInterface;

abstract class ArithmeticOperatorAbstract implements OperatorInterface
{

    /**
     * @param ArithmeticOperatorAbstract $operator
     * @return bool
     */
    public function equals(OperatorInterface $operator): bool
    {
        return $operator->getSign() === $this->getSign();
    }

    abstract function getSign(): string;

}