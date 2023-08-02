<?php

namespace App\Number;

use App\Number\Exception\InvalidNumberException;
use App\Number\Format\MaskBased\AppNumberFormat;
use App\Number\Format\MaskBased\Validator\NumberFormatValidator;

class Number implements NumberInterface
{

    private string $value;

    protected function __construct(string $value)
    {
        $validator = new NumberFormatValidator();

        $isValid = false;

        foreach ($this->getFormat()->getMasks() as $mask) {

            $isValid = $validator->validate($value, $mask);

            if ($isValid) {
                break;
            }

        }

        if (!$isValid) {
            throw new InvalidNumberException('Invalid number');
        }

        $this->value = $value;
    }

    protected function getFormat(): AppNumberFormat
    {
        return new AppNumberFormat();
    }

    public static function zero(): Number
    {
        return self::createFromString('0');
    }

    public static function createFromString(string $value): Number
    {
        return new Number($value);
    }

    public function getScale(): int
    {
        return strlen($this->value) - $this->getFractionStartPos() - 1;
    }

    /**
     * @return false|int
     */
    protected function getFractionStartPos(): int|false
    {
        return strpos($this->value, '.');
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function equals(NumberInterface $number): bool
    {
        if (!$number instanceof Number) {
            throw new \LogicException('Comparing to non decimals not implemented yet');
        }

        return $number->getValue() === $this->getValue();
    }

    public function getValue(): string
    {
        return $this->value;
    }

}