<?php

namespace App\Tests\Unit\Number\Format\Detector;

use App\Number\Format\Detector\RegisteredNumberFormatDetector;
use App\Number\Format\MaskBased\Validator\MaskBasedNumberFormatValidator;
use App\Number\Format\NumberFormatFactory;
use App\Number\Format\NumberFormatInterface;
use App\Number\Format\Validator\Exception\FormatNotSupportedException;
use PHPUnit\Framework\TestCase;

class RegisteredNumberFormatDetectorTest extends TestCase
{
    /**
     * @dataProvider guessProvider
     * @return void
     * @throws FormatNotSupportedException
     */
    public function testDetect($numberString, ?NumberFormatInterface $expected)
    {
        $formats = [
            NumberFormatFactory::int(),
            NumberFormatFactory::decimal()
        ];

        $validator = new MaskBasedNumberFormatValidator();

        $guesser = new RegisteredNumberFormatDetector($formats, $validator);

        $actual = $guesser->detect($numberString);

        if ($actual !== null) {
            $this->assertEquals($expected->getName(), $actual->getName());
        } else {
            $this->assertEquals($expected, $actual);
        }

    }

    public function guessProvider(): array
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
