<?php

namespace App\Calculator\Expression;

interface ExpressionInterface extends \Stringable
{

    public function getAsString(): string;

}