<?php

namespace maxlzp\household\accounting\household;

use maxlzp\household\entity\Id;
use Ramsey\Uuid\Uuid;

/**
 * Class HouseholdId
 * @package maxlzp\household\accounting\household
 */
class HouseholdId extends Id
{
    /**
     * Id constructor.
     *
     * @param string|null $id
     */
    public function __construct(string $id = null)
    {
        parent::__construct($id === null ? Uuid::uuid4() : $id);
    }

    /**
     * Check if two Id's are equal
     *
     * @param Id $other
     *
     * @return bool
     */
    public function equals(Id $other): bool
    {
        if ($this === $other) return true;
        return \strcmp($this->getId(), $other->getId()) === 0;
    }
}