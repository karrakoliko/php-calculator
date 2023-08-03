<?php

namespace App\Calculator\Result;

use App\Calculator\Operation\OperationInterface;

interface ResultInterface
{

    public function getOperation(): OperationInterface;

    public function getValue();

}