<?php

namespace App\Number;

use App\Number\Exception\InvalidNumberException;
use App\Number\Format\Guesser\RegisteredNumberFormatGuesser;
use App\Number\Format\MaskBased\MaskBasedInterface;
use App\Number\Format\MaskBased\Validator\MaskBasedNumberFormatValidator;
use App\Number\Format\NumberFormatFactory;
use App\Number\Format\NumberFormatInterface;

class Number implements NumberInterface
{

    private string $value;

    protected function __construct(string $value, NumberFormatInterface $format)
    {
        if (!self::isValidNumberString($value, $format)) {
            throw new InvalidNumberException('Invalid number');
        }

        $this->value = $value;
    }

    public static function isValidNumberString(string $value, NumberFormatInterface $format): bool
    {
        $validator = new MaskBasedNumberFormatValidator();

        /** @var MaskBasedInterface|NumberFormatInterface $format */
        return $validator->validate($value, $format);
    }

    public static function zero(): Number
    {
        return new Number(0, NumberFormatFactory::int());
    }

    public static function createFromString(string $value, ?NumberFormatInterface $format = null): Number
    {
        if ($format === null) {

            $numberFormatGuesser = self::getNumberFormatGuesser();

            $format = $numberFormatGuesser->guess($value);

            if ($format === null) {
                throw new InvalidNumberException('Invalid number: given number does not match any of supported formats');
            }
        }

        return new Number($value, $format);
    }

    /**
     * @return RegisteredNumberFormatGuesser
     */
    protected static function getNumberFormatGuesser(): RegisteredNumberFormatGuesser
    {
        return new RegisteredNumberFormatGuesser(
            [
                NumberFormatFactory::int(),
                NumberFormatFactory::decimal(),
            ],
            new MaskBasedNumberFormatValidator()
        );
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
        return $number->getValue() === $this->getValue();
    }

    public function getValue(): string
    {
        return $this->value;
    }

}