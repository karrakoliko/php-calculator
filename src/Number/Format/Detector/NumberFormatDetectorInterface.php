<?php

namespace App\Number\Format\Detector;

use App\Number\Format\NumberFormatInterface;

interface NumberFormatDetectorInterface
{

    /**
     * @param $number
     * @return NumberFormatInterface|null
     */
    public function detect($number): ?NumberFormatInterface;

}