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

    const SCALE = 8;
    private string $value;
    private NumberFormatInterface $format;

    protected function __construct(string $value, NumberFormatInterface $format)
    {
        $this->value = $value;
        $this->format = $format;
    }

    public static function zero(): Number
    {
        return new Number(0, NumberFormatFactory::int());
    }

    public static function createFromFloat(float $value): NumberInterface
    {

        $expPos = stripos($value, 'e');
        $dotPos = stripos($value, '.');

        if (!$dotPos) { // if no dot - treat as int
            return self::createFromString($value, NumberFormatFactory::int());
        }

        if ($expPos) { // "unwrap" exponent

            $formatted = number_format($value, self::SCALE, '.', '');

            $formatted = rtrim($formatted, '0');

            if (preg_match('~\.$~', $formatted)) {
                // truncate trailing zeros and return as int

                $formatted = substr($formatted, 0, strlen($formatted) - 1);

                return new Number($formatted, NumberFormatFactory::int());
            }

            return new Number($formatted, NumberFormatFactory::decimal());

        }

        // treat as decimal
        return self::createFromString($value, NumberFormatFactory::decimal());

    }

    public static function createFromString(string $value, ?NumberFormatInterface $format = null): Number
    {
        if ($format === null) {

            $format = self::guessFormatOrThrow($value, $format);

        } else {

            if (!self::isValidNumberString($value, $format)) {
                throw new InvalidNumberException('Invalid number');
            }
        }

        return new Number($value, $format);
    }

    /**
     * @param string $value
     * @param NumberFormatInterface|null $format
     * @return NumberFormatInterface
     */
    protected static function guessFormatOrThrow(string $value, ?NumberFormatInterface $format): NumberFormatInterface
    {
        $numberFormatGuesser = self::getNumberFormatGuesser();

        $format = $numberFormatGuesser->guess($value);

        if ($format === null) {
            throw new InvalidNumberException('Invalid number: given number does not match any of supported formats');
        }
        return $format;
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

    public static function isValidNumberString(string $value, NumberFormatInterface $format): bool
    {
        $validator = new MaskBasedNumberFormatValidator();

        /** @var MaskBasedInterface|NumberFormatInterface $format */
        return $validator->validate($value, $format);
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

    public function getFormat(): NumberFormatInterface
    {
        return $this->format;
    }
}