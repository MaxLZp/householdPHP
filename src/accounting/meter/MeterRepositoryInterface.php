<?php

namespace maxlzp\household\accounting\meter;

use maxlzp\household\accounting\household\HouseholdId;
use maxlzp\household\accounting\meter\exceptions\MeterNotFoundException;

/**
 * Class MeterRepositoryInterface
 * @package maxlzp\household\accounting\meter
 */
interface MeterRepositoryInterface
{
    /**
     * Add the meter to repository
     *
     * @param Meter $meter
     */
    function add(Meter $meter): void;

    /**
     * Get all meters
     *
     * @return MeterCollection
     */
    function getAll(): MeterCollection;

    /**
     * Get all meters installed at Household specified
     *
     * @param HouseholdId $householdId
     *
     * @return MeterCollection
     */
    function getFromHousehold(HouseholdId $householdId): MeterCollection;

    /**
     * Returns Meter with $id specified
     *
     * @param MeterId $id
     *
     * @return Meter
     *
     * @throws MeterNotFoundException
     */
    function meterOfId(MeterId $id): Meter;

    /**
     * Generate MeterId
     *
     * @return MeterId
     */
    function nextId(): MeterId;

    /**
     * Remove the meter from repository
     *
     * @param Meter $meter
     */
    function remove(Meter $meter): void;

    /**
     * Update the meter specified
     *
     * @param Meter $meter
     */
    function update(Meter $meter): void;
}