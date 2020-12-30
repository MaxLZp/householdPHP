<?php

namespace maxlzp\household\accounting\household;

use maxlzp\household\accounting\household\exceptions\HouseholdNotFoundException;

/**
 * Interface HouseholdRepository
 * @package maxlzp\household\accounting\household
 */
interface HouseholdRepository
{
    /**
     * Add the household to repository
     *
     * @param Household $household
     * @return mixed
     */
    function add(Household $household);

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
     * @return Household
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
     * @return mixed
     */
    function remove(Household $household);

    /**
     * Update the household specified
     *
     * @param Household $household
     * @return mixed
     */
    function update(Household $household);

}