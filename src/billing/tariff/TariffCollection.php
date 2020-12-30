<?php

namespace maxlzp\household\billing\tariff;

use Ramsey\Collection\Collection;

/**
 * Class TariffCollection
 * @package maxlzp\household\billing\tariff
 */
class TariffCollection extends Collection
{
    /**
     * TariffCollection constructor.
     * @param array $data
     */
    public function __construct(array $data = [])
    {
        parent::__construct(Tariff::class, $data);
    }
}