<?php

namespace App\Tests\Unit\Number;

use App\Number\Exception\InvalidNumberException;
use App\Number\Format\MaskBased\DecimalNumberFormat;
use App\Number\Format\NumberFormatFactory;
use App\Number\Number;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

class NumberTest extends TestCase
{

    /**
     * @dataProvider getScaleProvider
     * @param string $value
     * @param int $scaleExpected
     * @return null
     */
    public function testGetScale(string $value, int $scaleExpected)
    {

        $number = Number::createFromString($value, new DecimalNumberFormat());

        return $this->assertEquals($scaleExpected, $number->getScale());

    }

    public function getScaleProvider()
    {
        return [
            ['0.003', 3],
            ['0.0', 1],
        ];
    }

    /**
     * @dataProvider numberDoesNotMatchGivenFormatProvider
     * @return void
     */
    public function testCreateFromStringThrowsIfDoesNotMatchGivenFormat(string $value, string $formatName)
    {
        $this->expectException(InvalidNumberException::class);

        Number::createFromString($value, NumberFormatFactory::createByName($formatName));

    }

    public function numberDoesNotMatchGivenFormatProvider()
    {
        return [
            ['10.5', NumberFormatFactory::FORMAT_INT],
            ['10', NumberFormatFactory::FORMAT_DECIMAL],
        ];
    }

    /**
     * @dataProvider stringNumberProvider
     * @return void
     */
    public function testCreateFromString(string $val, string $formatName, $expectedValue)
    {
        $this->assertEquals($expectedValue, Number::createFromString($val, NumberFormatFactory::createByName($formatName))->getValue());
    }

    /**
     * @dataProvider floatNumberProvider
     * @return void
     */
    public function testCreateFromFloat(float $val, $expectedValue)
    {
        $this->assertEquals($expectedValue, Number::createFromFloat($val)->getValue());
    }

    public function floatNumberProvider()
    {
        return [
            '1.0E-8' => [1.0E-8, '0.00000001'],
            '1.0E-9' => [1.0E-9, '0'],
            '1.0E+35' => [1.0E+35, '99999999999999996863366107917975552'], // floating point math as is
        ];
    }

    /**
     * @dataProvider invalidStringDecimalProvider
     * @return void
     */
    public function testCreateFromStringThrowsIfInvalidNumberGiven(string $val)
    {
        $this->expectException(InvalidArgumentException::class);
        Number::createFromString($val)->getValue();
    }

    public function stringNumberProvider()
    {
        return [
            ['10', NumberFormatFactory::FORMAT_INT, 10],
            ['100.00', NumberFormatFactory::FORMAT_DECIMAL, 100],
            ['100.01', NumberFormatFactory::FORMAT_DECIMAL, 100.01]
        ];
    }

    public function invalidStringDecimalProvider()
    {
        return [
            ['.'],
            ['5$5.91'],
        ];
    }


}
