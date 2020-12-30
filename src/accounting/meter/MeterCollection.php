<?php

namespace maxlzp\household\accounting\meter;

use Ramsey\Collection\Collection;

/**
 * Class MeterCollection
 * @package maxlzp\household\accounting\meter
 */
class MeterCollection extends Collection
{
    /**
     * MeterCollection constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct(Meter::class, $data);
    }
}