<?php

namespace App\Number;

use App\Number\Format\NumberFormatInterface;

interface NumberInterface extends \Stringable
{

    public function getValue();

    public function equals(NumberInterface $number): bool;

    public static function createFromString(string $value, ?NumberFormatInterface $format = null): NumberInterface;
}