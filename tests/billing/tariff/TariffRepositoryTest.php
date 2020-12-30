<?php

namespace tests\billing\tariff;

use maxlzp\household\billing\tariff\exceptions\TariffNotFoundException;
use maxlzp\household\billing\tariff\Fixed;
use maxlzp\household\billing\tariff\TariffRepositoryInterface;
use maxlzp\household\billing\tariff\UsageValueBased;
use maxlzp\household\billing\usage\UsageValue;
use maxlzp\household\Money;
use PHPUnit\Framework\TestCase;
use tests\_mocks\billing\tariff\TariffRepositoryMock;

class TariffRepositoryTest extends TestCase
{
    /**
     * @var TariffRepositoryInterface
     */
    private $repository;

    public function setUp(): void
    {
        $this->repository = new TariffRepositoryMock();
    }

    /**
     * @test
     */
    public function shouldReturnEmptyCollection()
    {
        $tariffs = $this->repository->getAll();
        $this->assertEquals(0, $tariffs->count());
    }


    /**
     * @test
     */
    public function shouldAddTariffToRepository()
    {
        $tariff = new Fixed(
            $this->repository->nextId(),
            'Fixed Test Tariff',
            new Money(10, 'usd')
        );

        $this->repository->add($tariff);
        $found = $this->repository->tariffOfId($tariff->getId());

        $this->assertEquals(1, $this->repository->getAll()->count());
        $this->assertTrue($tariff->getId()->equals($found->getId()));
    }

    /**
     * @test
     * @depends shouldAddTariffToRepository
     */
    public function shouldReturnTariffsCollection()
    {
        $this->repository->add(
            new Fixed(
                $this->repository->nextId(),
                'Fixed Test Tariff 1',
                new Money(10, 'usd')
            )
        );
        $this->repository->add(
            new Fixed(
                $this->repository->nextId(),
                'Fixed Test Tariff 2',
                new Money(50, 'usd')
            )
        );
        $this->repository->add(
            new UsageValueBased(
                $this->repository->nextId(),
                'UsageBased Test Tariff',
                new Money(50, 'usd')
            )
        );

        $tariffs = $this->repository->getAll();
        $this->assertEquals(3, $tariffs->count());
    }

    /**
     * @test
     */
    public function shouldFindTariffAtRepository()
    {
        $tariff = new Fixed(
            $this->repository->nextId(),
            'Fixed Test Tariff',
            new Money(10, 'usd')
        );

        $this->repository->add($tariff);
        $found = $this->repository->tariffOfId($tariff->getId());

        $this->assertTrue($tariff->getId()->equals($found->getId()));
    }

    /**
     * @test
     */
    public function shouldNotFindTariffAtRepository()
    {
        $this->expectException(TariffNotFoundException::class);

        $tariff = new Fixed(
            $this->repository->nextId(),
            'Fixed Test Tariff',
            new Money(10, 'usd')
        );

        $found = $this->repository->tariffOfId($tariff->getId());
    }

    /**
     * @test
     * @depends shouldAddTariffToRepository
     */
    public function shouldRemoveTariffFromRepository()
    {
        $tariff = new Fixed(
            $this->repository->nextId(),
            'Fixed Test Tariff',
            new Money(10, 'usd')
        );

        $this->repository->add($tariff);
        $this->repository->remove($tariff);

        $this->assertEquals(0, $this->repository->getAll()->count());
    }

}
