<?php

namespace App\Number;

use App\Number\Format\NumberFormatInterface;
use Stringable;

interface NumberInterface extends Stringable
{

    public static function createFromString(string $value, ?NumberFormatInterface $format = null): NumberInterface;

    public static function createFromFloat(float $value): NumberInterface;

    public function getValue();

    public function getFormat(): NumberFormatInterface;

    public function equals(NumberInterface $number): bool;
}