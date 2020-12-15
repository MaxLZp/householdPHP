<?php

namespace tests\billing\tariff;

use maxlzp\household\billing\tariff\UsageValueRangeBased;
use maxlzp\household\billing\usage\UsageValue;
use maxlzp\household\Money;
use maxlzp\household\Range;
use PHPUnit\Framework\TestCase;

class UsageValueRangeBasedTest extends TestCase
{
    /**
     * @test
     * @dataProvider usageValues
     * @param $cost
     * @param $rangeStart
     * @param $rangeEnd
     * @param $usageValue
     * @param $expectedPrice
     * @throws \maxlzp\household\exceptions\InvalidRangeMargins
     */
    public function shouldGetFixedPriceForAllUsageValues(
        $cost,
        $rangeStart,
        $rangeEnd,
        $usageValue,
        $expectedPrice
    ) {
        $usage = new UsageValue($usageValue);
        $tariff = new UsageValueRangeBased('Test', new Money($cost, 'usd'), new Range($rangeStart, $rangeEnd));

        $this->assertEquals($expectedPrice, $tariff->getPriceFor($usage)->getValue());
    }

    /**
     * DataProvider for shouldGetFixedPriceForAllUsageValues
     */
    public function usageValues()
    {
        return [
            [100, 10, 20, 5, 0],
            [100, 10, 20, 15, 500],
            [100, 10, 20, 15.5, 550],
            [100, 10, 20, 25, 1000],
            [100, 10, INF, 11, 100],
            [100, 10, INF, 25, 1500],
        ];
    }
}
