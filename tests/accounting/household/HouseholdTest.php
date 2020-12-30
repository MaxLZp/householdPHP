<?php

namespace tests\accounting\household;

use maxlzp\household\accounting\household\Household;
use maxlzp\household\accounting\household\HouseholdId;
use maxlzp\household\accounting\meter\MeterId;
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
    public function shouldBeEqualToItself()
    {
        $household = new Household(new HouseholdId(), 'Home');

        $this->assertTrue($household->equals($household));
    }

    /**
     * @test
     */
    public function shouldBeEqualToSame()
    {
        $household = new Household(new HouseholdId(), 'Home');
        $other = new Household($household->getId(), $household->getTitle()->getTitle());

        $this->assertTrue($household->equals($other));
        $this->assertTrue($other->equals($household));
    }

    /**
     * @test
     */
    public function shouldNotBeEqualWithDifferentId()
    {
        $household = new Household(new HouseholdId(), 'Home');
        $other = new Household(new HouseholdId(), $household->getTitle()->getTitle());

        $this->assertFalse($household->equals($other));
        $this->assertFalse($other->equals($household));
    }

    /**
     *
     * @test
     */
    public function shouldNotBeEqualWithDifferentTitle()
    {
        $household = new Household(new HouseholdId(), 'Home');
        $other = new Household($household->getId(), 'Home2');

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
        $household = new Household(new HouseholdId(), $oldTitle);
        $household->rename($newTitle);

        $this->assertNotEquals($oldTitle, $household->getTitle()->getTitle());
        $this->assertEquals($newTitle, $household->getTitle()->getTitle());
    }

    /**
     * @test
     */
    public function shouldRegisterNewMeter()
    {
        $household = new Household(new HouseholdId(), 'Home');
        $meter = $household->registerMeter(
            new MeterId(),
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
        $household = new Household(new HouseholdId(), 'Home');
        $oldMeter = $household->registerMeter(
            new MeterId(),
            'Electric',
            new \DateTimeImmutable('now'),
            new MeterParameters()
        );
        $newMeter = $household->replaceMeter($oldMeter,
            new MeterId(),
            'Electric',
            new \DateTimeImmutable('now'),
            new MeterParameters()
        );

        $this->assertTrue($household->getId()->equals($newMeter->getHouseholdId()));
    }
}
