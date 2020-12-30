<?php

namespace maxlzp\household\accounting\household;

use Ramsey\Collection\Collection;

/**
 * Class HouseholdCollection
 * @package maxlzp\household\accounting\household
 */
class HouseholdCollection extends Collection
{
    /**
     * HouseholdCollection constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct(Household::class, $data);
    }
}