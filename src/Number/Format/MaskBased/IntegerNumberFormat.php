<?php

namespace App\Number\Format\MaskBased;

class IntegerNumberFormat implements MaskBasedInterface, \App\Number\Format\NumberFormatInterface
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