<?php

namespace App\Number\Format\Detector;

use App\Number\Format\NumberFormatInterface;
use App\Number\Format\Validator\Exception\FormatNotSupportedException;
use App\Number\Format\Validator\NumberFormatValidatorInterface;
use LogicException;

class RegisteredNumberFormatDetector implements NumberFormatDetectorInterface
{

    private array $formats;
    private NumberFormatValidatorInterface $validator;

    /**
     * @param NumberFormatInterface[] $formats
     * @param NumberFormatValidatorInterface $validator
     */
    public function __construct(array $formats, NumberFormatValidatorInterface $validator)
    {
        $this->formats = $formats;
        $this->validator = $validator;
    }

    /**
     * @throws FormatNotSupportedException
     */
    public function detect($number): ?NumberFormatInterface
    {
        if (!count($this->formats)) {
            throw new LogicException('No number format registered');
        }

        $guessed = null;

        foreach ($this->formats as $format) {

            if ($this->validator->validate($number, $format)) {
                $guessed = $format;
                break;
            }

        }

        return $guessed;
    }
}