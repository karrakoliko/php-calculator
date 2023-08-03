<?php

namespace App\Number\Format;

use App\Number\Format\MaskBased\DecimalNumberFormat;
use App\Number\Format\MaskBased\IntegerNumberFormat;

class NumberFormatFactory
{

    const FORMAT_INT = 'int';
    const FORMAT_DECIMAL = 'decimal';

    public static function int(): NumberFormatInterface
    {
        return self::createByName(self::FORMAT_INT);
    }

    public static function decimal(): NumberFormatInterface
    {
        return self::createByName(self::FORMAT_DECIMAL);
    }

    public static function createByName(string $name): NumberFormatInterface
    {
        $nameNormalized = strtolower($name);

        if ($nameNormalized === self::FORMAT_INT) {
            return new IntegerNumberFormat();
        }

        if ($nameNormalized === self::FORMAT_DECIMAL) {
            return new DecimalNumberFormat();
        }

        throw new \LogicException(sprintf('Unknown format name %s', $name));
    }

}