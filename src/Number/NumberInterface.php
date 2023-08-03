<?php

namespace App\Number;

use App\Number\Format\NumberFormatInterface;
use Stringable;

interface NumberInterface extends Stringable
{

    public static function createFromString(string $value, ?NumberFormatInterface $format = null): NumberInterface;

    public function getValue();

    public function equals(NumberInterface $number): bool;
}