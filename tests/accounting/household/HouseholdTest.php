<?php

namespace tests\accounting\household;

use maxlzp\household\accounting\household\Household;
use maxlzp\household\accounting\meter\MeterParameters;
use PHPUnit\Framework\TestCase;

/**
 * Class HouseholdTest
 *
 * Tests for
 *
 * @package tests\accounting
 */
class HouseholdTest extends TestCase
{
    /**
     * @test
     */
    public function shouldGenerateId()
    {
        $expectedTitle = 'Home';
        $household = new Household($expectedTitle);

        $this->assertNotNull($household->getId());
        $this->assertEquals($expectedTitle, $household->getTitle()->getTitle());
    }

    /**
     * @test
     */
    public function shouldBeEqualToItself()
    {
        $household = new Household('Home');

        $this->assertTrue($household->equals($household));
    }

    /**
     * @test
     */
    public function shouldBeEqualToSame()
    {
        $household = new Household('Home');
        $other = new Household($household->getTitle()->getTitle(), $household->getId()->getId());

        $this->assertTrue($household->equals($other));
        $this->assertTrue($other->equals($household));
    }

    /**
     * @test
     */
    public function shouldNotBeEqualWithDifferentId()
    {
        $household = new Household('Home');
        $other = new Household($household->getTitle()->getTitle());

        $this->assertFalse($household->equals($other));
        $this->assertFalse($other->equals($household));
    }

    /**
     *
     * @test
     */
    public function shouldNotBeEqualWithDifferentTitle()
    {
        $household = new Household('Home');
        $other = new Household('Home2', $household->getId()->getId());

        $this->assertFalse($household->equals($other));
        $this->assertFalse($other->equals($household));
    }

    /**
     *
     * @test
     */
    public function shouldRename()
    {
        $oldTitle = 'Home';
        $newTitle = 'Home2';
        $household = new Household($oldTitle);
        $household->rename($newTitle);

        $this->assertNotEquals($oldTitle, $household->getTitle()->getTitle());
        $this->assertEquals($newTitle, $household->getTitle()->getTitle());
    }

    /**
     * @test
     */
    public function shouldRegisterNewMeter()
    {
        $household = new Household('Home');
        $meter = $household->registerMeter(
            'Electric',
            new \DateTimeImmutable('now'),
            new MeterParameters()
        );

        $this->assertTrue($household->getId()->equals($meter->getHouseholdId()));
    }

    /**
     * @test
     */
    public function shouldReplaceMeter()
    {
        $household = new Household('Home');
        $oldMeter = $household->registerMeter(
            'Electric',
            new \DateTimeImmutable('now'),
            new MeterParameters()
        );
        $newMeter = $household->replaceMeter($oldMeter,
            'Electric',
            new \DateTimeImmutable('now'),
            new MeterParameters()
        );

        $this->assertTrue($household->getId()->equals($newMeter->getHouseholdId()));
    }
}
