<?php

namespace App\Number\Format\MaskBased;

use App\Number\Format\NumberFormatInterface;

class DecimalNumberFormat implements MaskBasedInterface, NumberFormatInterface
{

    public function getMaskRegexp(): string
    {
        return '~^(-?\d+\.\d+)$~';
    }

    public function isMaskBased(): bool
    {
        return true;
    }

    public function getName(): string
    {
        return 'decimal';
    }
}