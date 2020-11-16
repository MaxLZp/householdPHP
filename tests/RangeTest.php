<?php

namespace tests;

use maxlzp\household\exceptions\InvalidRangeMargins;
use maxlzp\household\Range;
use PHPUnit\Framework\TestCase;

class RangeTest extends TestCase
{

    /**
     * @test
     *
     * @throws InvalidRangeMargins
     */
    public function shouldThrowExceptionWhenInvalidRangeMarginsSupplied()
    {
        $this->expectException(InvalidRangeMargins::class);

        $range = new Range(10, 0);
    }

    /**
     * @test
     * @dataProvider WidthDataProvider
     *
     * @throws InvalidRangeMargins
     */
    public function shouldCalculateWidth($start, $end, $expectedWidth)
    {
        $range = new Range($start, $end);

        $this->assertEquals($expectedWidth, $range->getWidth());
    }

    /**
     * Provide data for shouldCalculateWidth-test
     */
    public function widthDataProvider()
    {
        return [
            [0, 10, 10],
            [0, 10.1, 10.1],
            [0.5, 10, 9.5],
        ];
    }
}
