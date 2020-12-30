<?php

namespace tests\_mocks\billing\tariff;

use maxlzp\household\billing\tariff\exceptions\TariffNotFoundException;
use maxlzp\household\billing\tariff\Tariff;
use maxlzp\household\billing\tariff\TariffCollection;
use maxlzp\household\billing\tariff\TariffId;
use maxlzp\household\billing\tariff\TariffRepositoryInterface;

/**
 * Class TarrifRepositoryMock
 * @package tests\_mocks\billing\tariff
 */
class TariffRepositoryMock implements TariffRepositoryInterface
{
    /**
     * @var TariffCollection
     */
    private $storage;

    /**
     * TarrifRepositoryMock constructor.
     */
    public function __construct()
    {
        $this->storage = new TariffCollection();
    }

    /**
     * Add tariff to repository
     *
     * @param Tariff $tariff
     */
    public function add(Tariff $tariff): void
    {
        $this->storage->add($tariff);
    }

    /**
     * Returns collection of all tariffs
     *
     * @return TariffCollection
     */
    public function getAll(): TariffCollection
    {
        return new TariffCollection($this->storage->toArray());
    }

    /**
     * Generate new TariffId
     *
     * @return TariffId
     */
    public function nextId(): TariffId
    {
        return new TariffId();
    }

    /**
     * Remove tariff
     *
     * @param Tariff $tariff
     */
    public function remove(Tariff $tariff): void
    {
        $this->storage->remove($tariff);
    }

    /**
     * Returns Tariff od id specified
     *
     * @param TariffId $id
     *
     * @return Tariff
     *
     * @throws TariffNotFoundException
     */
    public function tariffOfId(TariffId $id): Tariff
    {
        $tariffs = $this->storage->filter(function(Tariff $tariff) use ($id) {
            return $id->equals($tariff->getId());
        });
        if (\count($tariffs) > 0) {
            return $tariffs[0];
        }
        $this->throwTariffNotFoundException($id);
    }

    /**
     * Update tariff
     *
     * @param Tariff $tariff
     *
     * @throws TariffNotFoundException
     */
    public function update(Tariff $tariff): void
    {
        if ($this->storage->contains($tariff)) {
            return;
        }
        $this->throwTariffNotFoundException($tariff->getId());
    }

    /**
     * Throws TariffNotFoundException
     *
     * @param TariffId $id
     *
     * @throws TariffNotFoundException
     */
    private function throwTariffNotFoundException(TariffId $id): void
    {
        throw new TariffNotFoundException(sprintf("Cannot find tariff with id: %s", $id->getId()));
    }
}