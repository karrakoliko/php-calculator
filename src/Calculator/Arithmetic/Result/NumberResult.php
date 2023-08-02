<?php

namespace App\Calculator\Arithmetic\Result;

use App\Calculator\Result\ResultInterface;
use App\Number\NumberInterface;

class NumberResult implements ResultInterface
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
}