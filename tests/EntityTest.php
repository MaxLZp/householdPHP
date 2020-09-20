<?php

namespace tests;

use tests\_mocks\EntityMock;
use PHPUnit\Framework\TestCase;

/**
 * Class EntityTest
 *
 * Tests for Entity
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

}
