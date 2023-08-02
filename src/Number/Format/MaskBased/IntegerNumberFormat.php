<?php

namespace App\Number\Format\MaskBased;

class IntegerNumberFormat implements NumberFormatMaskBasedInterface
{

    public function getMaskRegexp(): string
    {
        return '~^(-?\d+)$~';
    }
}