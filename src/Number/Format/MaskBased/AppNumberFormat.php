<?php

namespace App\Number\Format\MaskBased;

use App\Number\Format\MaskBased;

class AppNumberFormat implements NumberFormatInterface
{

    public function getMasks(): array
    {
        return [
            new MaskBased\IntegerNumberFormat(),
            new MaskBased\DecimalNumberFormat()
        ];
    }
}