<?php

namespace App\Tests\Unit\Number\Format\Validator;

use App\Lib\NotificationBag\NotificationBag;
use App\Number\Format\MaskBased\Validator\MaskBasedNumberFormatValidator;
use App\Number\Format\NumberFormatFactory;
use PHPUnit\Framework\TestCase;

class NumberFormatValidatorTest extends TestCase
{
    /**
     * @dataProvider validateProvider
     * @param string $number
     * @param string $formatName
     * @param bool $resultBoolExpected
     * @return void
     */
    public function testValidate(string $number, string $formatName, bool $resultBoolExpected)
    {

        $validator = new MaskBasedNumberFormatValidator();

        $errors = new NotificationBag();

        $format = NumberFormatFactory::createByName($formatName);

        $resultBool = $validator->validate($number, $format);

        $this->assertEquals(
            $resultBoolExpected,
            $resultBool,
            sprintf('%s expected to be %s by format %s', $number, ($resultBoolExpected ? 'valid' : 'invalid'), $formatName)
        );

    }

    public function validateProvider()
    {
        return [
            '0 INT' => ['0', NumberFormatFactory::FORMAT_INT, true],
            '0 DECIMAL' => ['0', NumberFormatFactory::FORMAT_DECIMAL, false],
            '-5 INT' => ['-5', NumberFormatFactory::FORMAT_INT, true],
            '-0 INT' => ['-0', NumberFormatFactory::FORMAT_INT, true],
            '+0 INT' => ['+0', NumberFormatFactory::FORMAT_INT, false],
            '16g INT' => ['16g', NumberFormatFactory::FORMAT_INT, false],
            '16.05 INT' => ['16.05', NumberFormatFactory::FORMAT_INT, false],
            '. INT' => ['.', NumberFormatFactory::FORMAT_INT, false],
            '. DECIMAL' => ['.', NumberFormatFactory::FORMAT_DECIMAL, false],
            '7.0000000001E-5 INT' => ['7.0000000001E-5', NumberFormatFactory::FORMAT_INT, false],
            '7.0000000001E-5 DECIMAL' => ['7.0000000001E-5', NumberFormatFactory::FORMAT_DECIMAL, false]
        ];
    }
}
