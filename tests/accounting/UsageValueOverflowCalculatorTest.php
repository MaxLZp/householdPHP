<?php

namespace tests\accounting;

use maxlzp\household\accounting\MeterParameters;
use maxlzp\household\accounting\MeterReading;
use maxlzp\household\accounting\Usage;
use maxlzp\household\accounting\UsageValueCalculator;
use maxlzp\household\accounting\UsageValueOverflowCalculator;
use maxlzp\household\exceptions\InvalidMeterReadingsOrderException;
use maxlzp\household\Id;
use PHPUnit\Framework\TestCase;

class UsageValueOverflowCalculatorTest extends TestCase
{
    /**
     * @test
     *
     * @dataProvider calculateValueDataProvider
     *
     * @param float $current
     * @param float $previous
     * @param int   $digits
     * @param float $expected
     *
     * @throws \maxlzp\household\exceptions\InvalidMeterReadingsOrderException
     * @throws \Exception
     */
    public function shouldCalculateValue(
        float $current,
        float $previous,
        int $digits,
        float $expected
    ) {
        $usage = Usage::createFor(
            $this->createReading($current),
            $this->createReading($previous, new \DateTimeImmutable('yesterday')),
            $this->createMeterParameters($digits)
        );
        $calculator = new UsageValueOverflowCalculator($usage);

        $this->assertEquals($expected, $calculator->calculate());
    }

    /**
     * Data provider for shouldCalculateValue test
     *
     * @return array
     */
    public function calculateValueDataProvider(): array
    {
        //current, previous, meter digits, expected value
        return [
            [5, 95, 2, 10],
            [5, 95.5, 2, 9.5],
            [5.5, 95, 2, 10.5],
        ];
    }

    /**
     * @test
     *
     * @throws \maxlzp\household\exceptions\InvalidMeterReadingsOrderException
     * @throws \Exception
     */
    public function shouldThrowInvalidReadingsOrderException()
    {
        $this->expectException(InvalidMeterReadingsOrderException::class);

        $usage = Usage::createFor(
            $this->createReading(20),
            $this->createReading(10, new \DateTimeImmutable('yesterday')),
            $this->createMeterParameters(2)
        );
        $calculator = new UsageValueOverflowCalculator($usage);
    }

    /**
     * Create MeterReading instance
     *
     * @param float                   $value
     * @param \DateTimeImmutable|null $takenAt
     *
     * @return MeterReading
     *
     * @throws \Exception
     */
    private function createReading(
        float $value,
        \DateTimeImmutable $takenAt = null
    ): MeterReading
    {
        return new MeterReading(
            new Id('meterId'),
            $takenAt === null ? new \DateTimeImmutable('now') : $takenAt,
            $value
        );
    }

    /**
     * Create MeterParameters instance
     *
     * @param int $digits
     * @param int $precision
     *
     * @return MeterParameters
     */
    private function createMeterParameters(
        int $digits = 5,
        int $precision = 3
    ): MeterParameters
    {
        return new MeterParameters($digits, $precision);
    }
}
