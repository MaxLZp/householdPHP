<?php

namespace tests\accounting\reading;

use maxlzp\household\accounting\reading\MeterReadingId;
use PHPUnit\Framework\TestCase;

/**
 * Class HouseholdIdTest
 * @package tests\accounting\household
 */
class MeterReadingIdTest extends TestCase
{

    /**
     * @test
     */
    public function shouldConstructWithGivenValue()
    {
        $expectedId = '1234567890';
        $actualId = new MeterReadingId($expectedId);
        $this->assertEquals($expectedId, $actualId->getId());
    }

    /**
     * @test
     */
    public function shouldConstructWithGeneratedValue()
    {
        $id = new MeterReadingId();
        $this->assertNotEmpty($id->getId());
    }

    /**
     * @test
     */
    public function constructorMustGenerateUniqueValue()
    {
        $id1 = new MeterReadingId();
        $id2 = new MeterReadingId();
        $this->assertNotEquals($id1->getId(), $id2->getId());
    }

    /**
     * @test
     */
    public function shouldBeEqualToItself()
    {
        $id = new MeterReadingId();
        $this->assertTrue($id->equals($id));
    }

    /**
     * @test
     */
    public function shouldBeEqualToSameValue()
    {
        $id = new MeterReadingId();
        $id2 = new MeterReadingId($id->getId());
        $this->assertTrue($id->equals($id2));
        $this->assertTrue($id2->equals($id));
    }

    /**
     * @test
     */
    public function shouldNotBeEqualToDifferentId()
    {
        $id = new MeterReadingId();
        $id2 = new MeterReadingId();
        $this->assertFalse($id->equals($id2));
        $this->assertFalse($id2->equals($id));
    }
}
