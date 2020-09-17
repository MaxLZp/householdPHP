<?php

namespace tests;

use tests\mocks\EntityMock;
use PHPUnit\Framework\TestCase;

/**
 * Class EntityTest
 *
 * Tests for entities/Entity
 *
 * @package tests\entities
 */
class EntityTest extends TestCase
{

    /**
     * @test
     */
    public function shouldGenerateId()
    {
        $entity = new EntityMock();
        $this->assertNotNull($entity->getId());
    }

    /**
     * @test
     */
    public function shouldBeEqualToItself()
    {
        $entity = new EntityMock();
        $this->assertTrue($entity->equals($entity));
    }

    /**
     * @test
     */
    public function shouldBeEqualWithSameId()
    {
        $entity = new EntityMock();
        $other = new EntityMock($entity->getId());
        $this->assertTrue($entity->equals($entity));
        $this->assertTrue($entity->equals($entity));
    }

    /**
     * @test
     */
    public function shouldNotBeEqualToOther()
    {
        $entity = new EntityMock();
        $other = new EntityMock();
        $this->assertFalse($entity->equals($other));
        $this->assertFalse($other->equals($entity));
    }
}
