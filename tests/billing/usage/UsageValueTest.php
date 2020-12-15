<?php

namespace tests\accounting\billing\usage;

use maxlzp\household\billing\usage\UsageValue;
use maxlzp\household\Range;
use PHPUnit\Framework\TestCase;

class UsageValueTest extends TestCase
{

    /**
     * @test
     * @dataProvider portionDataProvider
     * @param $rangeStart
     * @param $rangeEnd
     * @param $fullValue
     * @param $expectedPortion
     *
     * @throws \maxlzp\household\exceptions\InvalidRangeMargins
     */
    public function shouldCreatePortion(
        $rangeStart,
        $rangeEnd,
        $fullValue,
        $expectedPortion
    )
    {
        $usage = new UsageValue($fullValue);
        $portion = $usage->within(new Range($rangeStart, $rangeEnd));
        $this->assertEquals($expectedPortion, $portion->getValue());
    }

    /**
     * DataProvider for shouldCreatePortion test
     */
    public function portionDataProvider()
    {
        return [
            [10, 20, 30, 10],
            [10, 20, 3, 0],
            [10, 20, 10, 0],
            [10, 20, 20, 10],
            [10, 20, 30, 10],
        ];
    }
}
