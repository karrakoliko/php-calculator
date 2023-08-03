<?php

namespace App\Calculator\Operator;

interface OperatorInterface
{

    public function equals(OperatorInterface $operator): bool;

}