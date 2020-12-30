<?php

namespace tests\billing\tariff;

use maxlzp\household\billing\tariff\Fixed;
use maxlzp\household\billing\tariff\TariffId;
use maxlzp\household\billing\usage\UsageValue;
use maxlzp\household\Money;
use PHPUnit\Framework\TestCase;

class FixedTest extends TestCase
{

    /**
     * @test
     * @dataProvider usageValues
     */
    public function shouldGetFixedPriceForAllUsageValues($usageValue)
    {
        $cost = 100;
        $usage = new UsageValue($usageValue);
        $tariff = new Fixed(new TariffId(), 'Test', new Money($cost, 'usd'));

        $this->assertEquals($cost, $tariff->getPriceFor($usage)->getValue());
    }

    /**
     * DataProvider for shouldGetFixedPriceForAllUsageValues
     */
    public function usageValues()
    {
        return [
            [1],
            [2],
            [10],
            [100],
        ];
    }
}
