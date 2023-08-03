<?php

namespace App\Number\Format\MaskBased;

class DecimalNumberFormat implements MaskBasedInterface, \App\Number\Format\NumberFormatInterface
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