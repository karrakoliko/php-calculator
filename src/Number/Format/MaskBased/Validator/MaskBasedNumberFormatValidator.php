<?php

namespace App\Number\Format\MaskBased\Validator;

use App\Number\Format\MaskBased\MaskBasedInterface;
use App\Number\Format\NumberFormatInterface;
use App\Number\Format\Validator\Exception\FormatNotSupportedException;

class MaskBasedNumberFormatValidator implements NumberFormatValidatorInterface
{
    /**
     * @param $number
     * @param NumberFormatInterface $format
     * @return bool
     * @throws FormatNotSupportedException
     */
    public function validate($number, NumberFormatInterface $format): bool
    {
        if (!$this->supportsFormat($format)) {
            throw new FormatNotSupportedException('Only ' . MaskBasedInterface::class . ' formats supported, ' . get_class($format) . ' given');
        }

        $mask = $format->getMaskRegexp();

        return preg_match($mask, $number) === 1;
    }

    /**
     * @param NumberFormatInterface $format
     * @return bool
     */
    public function supportsFormat(NumberFormatInterface $format): bool
    {
        return $format->isMaskBased();
    }
}