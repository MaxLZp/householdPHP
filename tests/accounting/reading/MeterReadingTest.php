<?php

namespace tests\accounting\reading;

use maxlzp\household\accounting\reading\MeterReading;
use maxlzp\household\Id;
use PHPUnit\Framework\TestCase;

class MeterReadingTest extends TestCase
{

    /**
     * @test
     */
    public function shouldBeCreatedWithGeneratedId()
    {
        $reading = new MeterReading(
            new Id('MeterId'),
            new \DateTimeImmutable('now'),
            12.354
        );

        $this->assertNotNull($reading->getId());
    }

    /**
     * @test
     */
    public function shouldBeEqualToItself()
    {
        $reading = new MeterReading(
            new Id('MeterId'),
            new \DateTimeImmutable('now'),
            12.354
        );

        $this->assertTrue($reading->equals($reading));
    }

    /**
     * @test
     */
    public function shouldNoBeEqualToOther()
    {
        $reading = new MeterReading(
            new Id('MeterId'),
            new \DateTimeImmutable('now'),
            12.354
        );
        $reading2 = new MeterReading(
            new Id('MeterId'),
            new \DateTimeImmutable('now'),
            12.354
        );

        $this->assertFalse($reading->equals($reading2));
    }
}
