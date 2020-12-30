<?php

namespace maxlzp\household\accounting\reading;

use Ramsey\Collection\Collection;

/**
 * Class MeterReadingCollection
 * @package maxlzp\household\accounting\reading
 */
class MeterReadingCollection extends Collection
{
    /**
     * MeterReadingCollection constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct(MeterReading::class, $data);
    }
}