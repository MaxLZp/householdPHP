<?php

namespace tests\accounting;

use maxlzp\household\accounting\MeterParameters;
use PHPUnit\Framework\TestCase;

class MeterParametersTest extends TestCase
{
    /**
     * @test
     */
    public function shouldHaveDefaultDigitsValueOf5()
    {
        $expectedDefaultDigitsValue = 5;
        $parameters = new MeterParameters();

        $this->assertEquals($expectedDefaultDigitsValue, $parameters->getDigits());
    }

    /**
     * @test
     */
    public function shouldHaveDefaultPrecisionValueOf3()
    {
        $expectedDefaultPrecisionValue = 3;
        $parameters = new MeterParameters();

        $this->assertEquals($expectedDefaultPrecisionValue, $parameters->getPrecision());
    }

    /**
     * @test
     */
    public function shouldHaveDefaultMaximumValueOf10000()
    {
        $expectedMaximumValue = 100000;
        $parameters = new MeterParameters();

        $this->assertEquals($expectedMaximumValue, $parameters->getMaximumValue());
    }
}
