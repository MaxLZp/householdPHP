<?php

namespace tests\accounting\household;

//use maxlzp\household\accounting\household\HouseholdId;
use maxlzp\household\billing\tariff\TariffId;
use PHPUnit\Framework\TestCase;

/**
 * Class HouseholdIdTest
 * @package tests\accounting\household
 */
class TariffIdTest extends TestCase
{

    /**
     * @test
     */
    public function shouldConstructWithGivenValue()
    {
        $expectedId = '1234567890';
        $actualId = new TariffId($expectedId);
        $this->assertEquals($expectedId, $actualId->getId());
    }

    /**
     * @test
     */
    public function shouldConstructWithGeneratedValue()
    {
        $id = new TariffId();
        $this->assertNotEmpty($id->getId());
    }

    /**
     * @test
     */
    public function constructorMustGenerateUniqueValue()
    {
        $id1 = new TariffId();
        $id2 = new TariffId();
        $this->assertNotEquals($id1->getId(), $id2->getId());
    }

    /**
     * @test
     */
    public function shouldBeEqualToItself()
    {
        $id = new TariffId();
        $this->assertTrue($id->equals($id));
    }

    /**
     * @test
     */
    public function shouldBeEqualToSameValue()
    {
        $id = new TariffId();
        $id2 = new TariffId($id->getId());
        $this->assertTrue($id->equals($id2));
        $this->assertTrue($id2->equals($id));
    }

    /**
     * @test
     */
    public function shouldNotBeEqualToDifferentId()
    {
        $id = new TariffId();
        $id2 = new TariffId();
        $this->assertFalse($id->equals($id2));
        $this->assertFalse($id2->equals($id));
    }
}
