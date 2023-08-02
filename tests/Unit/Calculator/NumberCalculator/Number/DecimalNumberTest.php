<?php

namespace App\Tests\Unit\Calculator\NumberCalculator\Number;

use App\Number\Number;
use PHPUnit\Framework\TestCase;

class DecimalNumberTest extends TestCase
{

    /**
     * @dataProvider getScaleProvider
     * @param string $value
     * @param int $scaleExpected
     * @return null
     */
    public function testGetScale(string $value, int $scaleExpected)
    {

        $number = Number::createFromString($value);

        return $this->assertEquals($scaleExpected, $number->getScale());

    }

    public function getScaleProvider()
    {
        return [
            ['0.003',3],
            ['0.0',1],
        ];
    }

    /**
     * @dataProvider stringDecimalProvider
     * @return void
     */
    public function testCreateFromString(string $val, $expected)
    {
        $this->assertEquals(Number::createFromString($val)->getValue(), $expected);
    }

    /**
     * @dataProvider invalidStringDecimalProvider
     * @return void
     */
    public function testCreateFromStringThrowsIfInvalidNumberGiven(string $val)
    {
        $this->expectException(\InvalidArgumentException::class);
        Number::createFromString($val)->getValue();
    }

    public function stringDecimalProvider()
    {
        return [
            ['10', 10],
            ['100.00', 100],
            ['100.01', 100.01]
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
