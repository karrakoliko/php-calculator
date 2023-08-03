<?php

namespace App\Number\Format\Validator;

use App\Number\Format\NumberFormatInterface;
use App\Number\Format\Validator\Exception\FormatNotSupportedException;

interface NumberFormatValidatorInterface
{
    /**
     * @param $number
     * @param NumberFormatInterface $format
     * @return bool
     * @throws FormatNotSupportedException
     */
    public function validate($number, NumberFormatInterface $format): bool;

    public function supportsFormat(NumberFormatInterface $format): bool;

}