<?php

namespace tests\billing\tariff;

use maxlzp\household\billing\tariff\TariffId;
use maxlzp\household\billing\tariff\UsageValueBased;
use maxlzp\household\billing\usage\UsageValue;
use maxlzp\household\Money;
use PHPUnit\Framework\TestCase;

class UsageValueBasedTest extends TestCase
{
    /**
     * @test
     * @dataProvider usageValues
     * @param $cost
     * @param $usageValue
     * @param $expectedPrice
     */
    public function shouldGetFixedPriceForAllUsageValues(
        $cost,
        $usageValue,
        $expectedPrice
    ) {
        $usage = new UsageValue($usageValue);
        $tariff = new UsageValueBased(new TariffId(), 'Test', new Money($cost, 'usd'));

        $this->assertEquals($expectedPrice, $tariff->getPriceFor($usage)->getValue());
    }

    /**
     * DataProvider for shouldGetFixedPriceForAllUsageValues
     */
    public function usageValues()
    {
        return [
            [1, 1, 1],
            [100, 1, 100],
            [100, 50, 5000],
            [100, 50.55, 5055],
        ];
    }
}
