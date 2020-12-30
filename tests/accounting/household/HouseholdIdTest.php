<?php

namespace tests\accounting\household;

use maxlzp\household\accounting\household\HouseholdId;
use PHPUnit\Framework\TestCase;

/**
 * Class HouseholdIdTest
 * @package tests\accounting\household
 */
class HouseholdIdTest extends TestCase
{

    /**
     * @test
     */
    public function shouldConstructWithGivenValue()
    {
        $expectedId = '1234567890';
        $actualId = new HouseholdId($expectedId);
        $this->assertEquals($expectedId, $actualId->getId());
    }

    /**
     * @test
     */
    public function shouldConstructWithGeneratedValue()
    {
        $id = new HouseholdId();
        $this->assertNotEmpty($id->getId());
    }

    /**
     * @test
     */
    public function constructorMustGenerateUniqueValue()
    {
        $id1 = new HouseholdId();
        $id2 = new HouseholdId();
        $this->assertNotEquals($id1->getId(), $id2->getId());
    }

    /**
     * @test
     */
    public function shouldBeEqualToItself()
    {
        $id = new HouseholdId();
        $this->assertTrue($id->equals($id));
    }

    /**
     * @test
     */
    public function shouldBeEqualToSameValue()
    {
        $id = new HouseholdId();
        $id2 = new HouseholdId($id->getId());
        $this->assertTrue($id->equals($id2));
        $this->assertTrue($id2->equals($id));
    }

    /**
     * @test
     */
    public function shouldNotBeEqualToDifferentId()
    {
        $id = new HouseholdId();
        $id2 = new HouseholdId();
        $this->assertFalse($id->equals($id2));
        $this->assertFalse($id2->equals($id));
    }
}
