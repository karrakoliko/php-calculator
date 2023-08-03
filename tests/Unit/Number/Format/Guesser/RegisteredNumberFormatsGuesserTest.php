<?php

namespace App\Tests\Unit\Number\Format\Guesser;

use App\Number\Format\Guesser\RegisteredNumberFormatGuesser;
use App\Number\Format\MaskBased\Validator\MaskBasedNumberFormatValidator;
use App\Number\Format\NumberFormatFactory;
use App\Number\Format\NumberFormatInterface;
use PHPUnit\Framework\TestCase;

class RegisteredNumberFormatsGuesserTest extends TestCase
{
    /**
     * @dataProvider guessProvider
     * @return void
     */
    public function testGuess($numberString, ?NumberFormatInterface $expected)
    {
        $formats = [
            NumberFormatFactory::int(),
            NumberFormatFactory::decimal()
        ];

        $validator = new MaskBasedNumberFormatValidator();

        $guesser = new RegisteredNumberFormatGuesser($formats, $validator);

        $actual = $guesser->guess($numberString);

        if ($actual !== null) {
            $this->assertEquals($expected->getName(), $actual->getName());
        } else {
            $this->assertEquals($expected, $actual);
        }

    }

    public function guessProvider()
    {
        return [
            [0, NumberFormatFactory::int()],
            [-5, NumberFormatFactory::int()],
            [0.5, NumberFormatFactory::decimal()],
            [-0.5, NumberFormatFactory::decimal()],
            ['af', null]
        ];
    }
}
