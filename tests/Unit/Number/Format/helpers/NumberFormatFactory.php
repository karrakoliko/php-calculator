<?php

namespace App\Tests\Unit\Number\Format\helpers;

use App\Number\Format\MaskBased\DecimalNumberFormat;
use App\Number\Format\MaskBased\IntegerNumberFormat;
use App\Number\Format\MaskBased\NumberFormatMaskBasedInterface;

class NumberFormatFactory
{

    const FORMAT_INT = 'int';
    const FORMAT_DECIMAL = 'decimal';

    public static function createByName(string $name): NumberFormatMaskBasedInterface
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