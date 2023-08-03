<?php

namespace App\Number\Format\MaskBased;

use App\Number\Format\NumberFormatInterface;

class IntegerNumberFormat implements MaskBasedInterface, NumberFormatInterface
{

    public function getMaskRegexp(): string
    {
        return '~^(-?\d+)$~';
    }

    public function isMaskBased(): bool
    {
        return true;
    }

    public function getName(): string
    {
        return 'integer';
    }
}