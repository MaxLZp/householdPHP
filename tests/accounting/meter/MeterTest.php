<?php

namespace tests\accounting;

use maxlzp\household\accounting\household\HouseholdId;
use maxlzp\household\accounting\meter\Meter;
use maxlzp\household\accounting\meter\MeterId;
use maxlzp\household\accounting\meter\MeterParameters;
use maxlzp\household\exceptions\MeterReadingValueExceedsMaxMtereValueException;
use PHPUnit\Framework\TestCase;

class MeterTest extends TestCase
{
    /**
     * @test
     */
    public function shouldHaveGeneratedId()
    {
        $meter = new Meter(new MeterId(), new HouseholdId('householdId'), 'TheMeter', new \DateTimeImmutable('now'), new MeterParameters());
        $this->assertNotNull($meter->getId());
    }

    /**
     * @test
     */
    public function shouldHaveNullReplacementDateByDefault()
    {
        $meter = new Meter(new MeterId(), new HouseholdId('householdId'), 'TheMeter', new \DateTimeImmutable('now'), new MeterParameters());
        $this->assertNull($meter->getReplacementDate());
    }


    /**
     * @test
     */
    public function shouldNotBeIsReplacedWhenReplaced()
    {
        $meter = new Meter(new MeterId(), new HouseholdId('householdId'), 'TheMeter', new \DateTimeImmutable('now'), new MeterParameters());
        $this->assertFalse($meter->isReplaced());
    }

    /**
     * @test
     */
    public function shouldBeIsReplacedWhenReplaced()
    {
        $meter = new Meter(new MeterId(), new HouseholdId('householdId'), 'TheMeter', new \DateTimeImmutable('now'), new MeterParameters());
        $meter->replace(new \DateTimeImmutable('now'));
        $this->assertTrue($meter->isReplaced());
    }

    /**
     * @test
     */
    public function shouldHaveReplacementDateWhenReplaced()
    {
        $meter = new Meter(new MeterId(), new HouseholdId('householdId'), 'TheMeter', new \DateTimeImmutable('now'), new MeterParameters());
        $meter->replace(new \DateTimeImmutable('now'));
        $this->assertNotNull($meter->getReplacementDate());
    }

    /**
     * @test
     */
    public function shouldCreateReading()
    {
        $meter = new Meter(new MeterId(), new HouseholdId('householdId'), 'TheMeter', new \DateTimeImmutable('now'), new MeterParameters());

        $reading = $meter->takeReading(new \DateTimeImmutable('now'), 123);

        $this->assertNotNull($reading);
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenReadingValueExceedsMeterMaxValue()
    {
        $this->expectException(MeterReadingValueExceedsMaxMtereValueException::class);

        $meter = new Meter(new MeterId(), new HouseholdId('householdId'), 'TheMeter', new \DateTimeImmutable('now'), new MeterParameters(2));

        $reading = $meter->takeReading(new \DateTimeImmutable('now'), 123);

    }

}
