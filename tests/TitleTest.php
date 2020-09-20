<?php

namespace tests;

use maxlzp\household\Title;
use PHPUnit\Framework\TestCase;
use tests\_mocks\TitleMock;

/**
 * Class TitleTest
 *
 * Tests for Title
 *
 * @package tests
 */
class TitleTest extends TestCase
{

    /**
     * @test
     */
    public function shouldBeEqualToItself()
    {
        $expected = 'Title';
        $title = new TitleMock($expected);

        $this->assertTrue($title->equals($title));
    }

    /**
     * @test
     */
    public function shouldBeEqualToSame()
    {
        $expected = 'Title';
        $title = new TitleMock($expected);
        $other = new TitleMock($expected);

        $this->assertTrue($title->equals($other));
        $this->assertTrue($other->equals($title));
    }

    /**
     * @test
     */
    public function shouldNotBeEqualToDifferent()
    {
        $title = new TitleMock('First');
        $other = new TitleMock('Second');

        $this->assertFalse($title->equals($other));
        $this->assertFalse($other->equals($title));
    }

}
