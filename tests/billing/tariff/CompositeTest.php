<?php

namespace tests\billing\tariff;

use maxlzp\household\billing\PriceableCollection;
use maxlzp\household\billing\tariff\Composite;
use maxlzp\household\billing\tariff\Fixed;
use maxlzp\household\billing\tariff\TariffId;
use maxlzp\household\billing\tariff\UsageValueBased;
use maxlzp\household\billing\tariff\UsageValueRangeBased;
use maxlzp\household\billing\usage\UsageValue;
use maxlzp\household\Money;
use maxlzp\household\Range;
use PHPUnit\Framework\TestCase;

class CompositeTest extends TestCase
{
    /**
     * @test
     * @dataProvider calculatePriceDataProvider
     */
    public function shouldCalculatePrice(
        $usage,
        $expected,
        $children
    )
    {
        $composite = new Composite(new TariffId(), 'Test', new PriceableCollection($children));
        $price = $composite->getPriceFor(new UsageValue($usage));
        $this->assertEquals($expected, $price->getValue());
    }

    /**
     *
     * @throws \maxlzp\household\exceptions\InvalidRangeMargins
     */
    public function calculatePriceDataProvider()
    {
        return [
            [0, 0, []],
            [0, 0, [
                new Fixed(new TariffId(), 'Fixed', new Money(0, 'usd'))
            ]
            ],
            [10, 0, [
                new Fixed(new TariffId(), 'Fixed', new Money(0, 'usd'))
            ]
            ],
            [10, 10, [
                new Fixed(new TariffId(), 'Fixed', new Money(10, 'usd'))
            ]
            ],
            [10, 100, [
                new UsageValueBased(new TariffId(), 'UsageValueBased', new Money(10, 'usd'))
            ]
            ],
            [10, 110, [
                new Fixed(new TariffId(), 'Fixed', new Money(10, 'usd')),
                new UsageValueBased(new TariffId(), 'UsageValueBased', new Money(10, 'usd'))
            ]
            ],
            [250, 1000 + 2000 + 50*30, [
                new UsageValueRangeBased(new TariffId(), 'UsageValueRangeBased', new Money(10, 'usd'), new Range(0, 100)),
                new UsageValueRangeBased(new TariffId(), 'UsageValueRangeBased', new Money(20, 'usd'), new Range(100, 200)),
                new UsageValueRangeBased(new TariffId(), 'UsageValueRangeBased', new Money(30, 'usd'), new Range(200, INF))
            ]
            ],
            [250, 1000 + 2000 + 50*30 + 10, [
                new UsageValueRangeBased(new TariffId(), 'UsageValueRangeBased', new Money(10, 'usd'), new Range(0, 100)),
                new UsageValueRangeBased(new TariffId(), 'UsageValueRangeBased', new Money(20, 'usd'), new Range(100, 200)),
                new UsageValueRangeBased(new TariffId(), 'UsageValueRangeBased', new Money(30, 'usd'), new Range(200, INF)),
                new Fixed(new TariffId(), 'Fixed', new Money(10, 'usd')),
            ]
            ],
        ];
    }
}
