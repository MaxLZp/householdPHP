<?php

namespace maxlzp\household\billing\tariff;

use maxlzp\household\billing\tariff\exceptions\TariffNotFoundException;

/**
 * Interface TariffRepositoryInterface
 * @package maxlzp\household\billing\tariff
 */
interface TariffRepositoryInterface
{
    /**
     * Add tariff to repository
     *
     * @param Tariff $tariff
     */
    public function add(Tariff $tariff): void;

    /**
     * Returns collection of all tariffs
     *
     * @return TariffCollection
     */
    public function getAll(): TariffCollection;

    /**
     * Generate new TariffId
     *
     * @return TariffId
     */
    public function nextId(): TariffId;

    /**
     * Remove tariff
     *
     * @param Tariff $tariff
     */
    public function remove(Tariff $tariff):void;

    /**
     * Returns Tariff od id specified
     *
     * @param TariffId $id
     *
     * @return Tariff
     *
     * @throws TariffNotFoundException
     */
    public function tariffOfId(TariffId $id): Tariff;

    /**
     * Update tariff
     *
     * @param Tariff $tariff
     */
    public function update(Tariff $tariff): void;
}