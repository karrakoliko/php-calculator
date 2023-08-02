<?php

namespace App\Number\Format\Validator;

use App\Number\Format\NumberFormatInterface;
use App\Number\Format\Validator\Exception\FormatNotSupportedException;

interface NumberFormatValidatorInterface
{
    /**
     * @param $number
     * @param NumberFormatInterface $format
     * @throws FormatNotSupportedException
     * @return bool
     */
    public function validate($number, NumberFormatInterface $format): bool;

}