<?php

namespace maxlzp\household\accounting\meter;

use maxlzp\household\TitleTrait;

/**
 * Class MeterTitle
 *
 * @package maxlzp\household\accounting
 */
class MeterTitle
{
    use TitleTrait;

    /**
     * MeterTitle constructor.
     * @param string $title
     */
    public function __construct(string $title)
    {
        $this->title = $title;
    }


    /**
     * @param MeterTitle $other
     * @return bool
     */
    public function equals(MeterTitle $other): bool
    {
        return strcmp($this->getTitle(), $other->getTitle()) === 0;
    }
}