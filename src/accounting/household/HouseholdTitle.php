<?php

namespace maxlzp\household\accounting\household;

use maxlzp\household\TitleTrait;

/**
 * Class HouseholdTitle
 *
 * @package maxlzp\household\accounting
 */
class HouseholdTitle
{

    use TitleTrait;

    /**
     * HouseholdTitle constructor.
     * @param string $title
     */
    public function __construct(string $title)
    {
        $this->title = $title;
    }

    /**
     * @param HouseholdTitle $other
     * @return bool
     */
    public function equals(HouseholdTitle $other): bool
    {
        return strcmp($this->getTitle(), $other->getTitle()) === 0;
    }
}