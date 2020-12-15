<?php

namespace tests\accounting\billing\usage;

use maxlzp\household\accounting\meter\MeterParameters;
use maxlzp\household\accounting\reading\MeterReading;
use maxlzp\household\billing\usage\Usage;
use maxlzp\household\exceptions\InvalidMeterReadingsOrderException;
use maxlzp\household\Id;
use PHPUnit\Framework\TestCase;

/**
 * Class UsageTest
 *
 * @package tests\accounting
 */
class UsageTest extends TestCase
{
    /**
     * @test
     *
     * @throws \Exception
     */
    public function shouldThrowInvalidMeterReadingsOrderException()
    {
        $this->expectException(InvalidMeterReadingsOrderException::class);

        $usage = Usage::createFor(
            $this->createReading(10, new \DateTimeImmutable('yesterday')),
            $this->createReading(10),
            $this->createMeterParameters(5, 3)
        );
    }

    /**
     * @test
     *
     * @throws InvalidMeterReadingsOrderException
     * @throws \Exception
     */
    public function shouldNotThrowInvalidMeterReadingsOrderException()
    {
        $usage = Usage::createFor(
            $this->createReading(10),
            $this->createReading(10, new \DateTimeImmutable('yesterday')),
            $this->createMeterParameters()
        );

        $this->assertNotNull($usage);
    }


//
//    /**
//     * @test
//     *
//     * @dataProvider getValueProperlyProvider
//     *
//     * @param float $current
//     * @param float $previous
//     * @param int   $digits
//     * @param float $expected
//     *
//     * @throws \Exception
//     */
//    public function shouldGetValueProperly(
//        float $current,
//        float $previous,
//        int $digits,
//        float $expected
//    ) {
//        $usage = Usage::createFor(
//            $this->createReading($current),
//            $this->createReading($previous, new \DateTimeImmutable('yesterday')),
//            $this->createMeterParameters($digits)
//        );
//
//        $this->assertEquals($expected, $usage->getValue());
//
//    }
//
//    /**
//     * @return array
//     */
//    public function getValueProperlyProvider(): array
//    {
//        //current, previous, meter digits, expected value
//        return [
//            [20, 10, 5, 10],
//            [20.5, 10, 5, 10.5],
//            [5, 95, 2, 10],
//            [5, 95.5, 2, 9.5],
//            [5.5, 95, 2, 10.5],
//        ];
//    }

    /**
     * Create MeterReading instance
     *
     * @param float $value
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
