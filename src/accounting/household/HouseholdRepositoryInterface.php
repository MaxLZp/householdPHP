<?php

namespace maxlzp\household\accounting\household;

use maxlzp\household\accounting\household\exceptions\HouseholdNotFoundException;

/**
 * Interface HouseholdRepositoryInterface
 * @package maxlzp\household\accounting\household
 */
interface HouseholdRepositoryInterface
{
    /**
     * Add the household to repository
     *
     * @param Household $household
     */
    function add(Household $household): void;

    /**
     * Get all households
     *
     * @return HouseholdCollection
     */
    function getAll(): HouseholdCollection;

    /**
     * Returns Household with $id specified
     *
     * @param HouseholdId $id
     *
     * @return Household
     *
     * @throws HouseholdNotFoundException
     */
    function householdOfId(HouseholdId $id): Household;

    /**
     * Generate HouseholdId
     *
     * @return HouseholdId
     */
    function nextId(): HouseholdId;

    /**
     * Remove the household from repository
     *
     * @param Household $household
     */
    function remove(Household $household): void;

    /**
     * Update the household specified
     *
     * @param Household $household
     *
     * @return mixed
     */
    function update(Household $household): void;

}