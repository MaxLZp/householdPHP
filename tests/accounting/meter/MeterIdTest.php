<?php

namespace tests\accounting\meter;

use maxlzp\household\accounting\meter\MeterId;
use PHPUnit\Framework\TestCase;

/**
 * Class HouseholdIdTest
 * @package tests\accounting\household
 */
class MeterIdTest extends TestCase
{

    /**
     * @test
     */
    public function shouldConstructWithGivenValue()
    {
        $expectedId = '1234567890';
        $actualId = new MeterId($expectedId);
        $this->assertEquals($expectedId, $actualId->getId());
    }

    /**
     * @test
     */
    public function shouldConstructWithGeneratedValue()
    {
        $id = new MeterId();
        $this->assertNotEmpty($id->getId());
    }

    /**
     * @test
     */
    public function constructorMustGenerateUniqueValue()
    {
        $id1 = new MeterId();
        $id2 = new MeterId();
        $this->assertNotEquals($id1->getId(), $id2->getId());
    }

    /**
     * @test
     */
    public function shouldBeEqualToItself()
    {
        $id = new MeterId();
        $this->assertTrue($id->equals($id));
    }

    /**
     * @test
     */
    public function shouldBeEqualToSameValue()
    {
        $id = new MeterId();
        $id2 = new MeterId($id->getId());
        $this->assertTrue($id->equals($id2));
        $this->assertTrue($id2->equals($id));
    }

    /**
     * @test
     */
    public function shouldNotBeEqualToDifferentId()
    {
        $id = new MeterId();
        $id2 = new MeterId();
        $this->assertFalse($id->equals($id2));
        $this->assertFalse($id2->equals($id));
    }
}
