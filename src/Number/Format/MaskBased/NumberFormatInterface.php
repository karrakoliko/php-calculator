<?php

namespace App\Number\Format\MaskBased;

interface NumberFormatInterface extends \App\Number\Format\NumberFormatInterface
{

    /**
     * @return NumberFormatMaskBasedInterface[]
     */
    public function getMasks(): array;

}