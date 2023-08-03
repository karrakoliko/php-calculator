<?php

namespace App\Calculator\Expression;

use Stringable;

interface ExpressionInterface extends Stringable
{

    public function getAsString(): string;

}