<?php

namespace tests;

use maxlzp\household\Id;
use PHPUnit\Framework\TestCase;

/**
 * Class IdTest
 *
 * Tests for entities/Id
 *
 * @package tests
 */
class IdTest extends TestCase
{

    /**
     * @test
     */
    public function shouldConstructWithGivenValue()
    {
        $expectedId = '1234567890';
        $actualId = new Id($expectedId);
        $this->assertEquals($expectedId, $actualId->getId());
    }

    /**
     * @test
     */
    public function shouldConstructWithGeneratedValue()
    {
        $id = new Id();
        $this->assertNotEmpty($id->getId());
    }

    /**
     * @test
     */
    public function constructorMustGenerateUniqueValue()
    {
        $id1 = new Id();
        $id2 = new Id();
        $this->assertNotEquals($id1->getId(), $id2->getId());
    }

    /**
     * @test
     */
    public function shouldBeEqualToItself()
    {
        $id = new Id();
        $this->assertTrue($id->equals($id));
    }

    /**
     * @test
     */
    public function shouldBeEqualToSameValue()
    {
        $id = new Id();
        $id2 = new Id($id->getId());
        $this->assertTrue($id->equals($id2));
        $this->assertTrue($id2->equals($id));
    }

    /**
     * @test
     */
    public function shouldNotBeEqualToDifferentId()
    {
        $id = new Id();
        $id2 = new Id();
        $this->assertFalse($id->equals($id2));
        $this->assertFalse($id2->equals($id));
    }
}
