<?php

namespace App\Number\Format\MaskBased\Validator;

use App\Number\Format\MaskBased\NumberFormatMaskBasedInterface;
use App\Number\Format\Validator\Exception\FormatNotSupportedException;

class NumberFormatValidator implements NumberFormatValidatorInterface
{

    public function validate($number, $format): bool
    {

        if (!$format instanceof NumberFormatMaskBasedInterface) {
            throw new FormatNotSupportedException('Only ' . NumberFormatMaskBasedInterface::class . ' formats supported, ' . get_class($format) . ' given');
        }

        $mask = $format->getMaskRegexp();

        return preg_match($mask, $number) === 1;
    }
}