<?php

namespace App\Number\Format\MaskBased;

class DecimalNumberFormat implements NumberFormatMaskBasedInterface
{

    public function getMaskRegexp(): string
    {
        return '~^(-?\d+\.\d+)$~';
    }
}