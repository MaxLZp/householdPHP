<?php

namespace maxlzp\household\billing;


use Ramsey\Collection\Collection;

class PriceableCollection extends Collection
{
    /**
     * PriceableCollection constructor.
     * @param array|null $data
     */
    public function __construct(array $data = null)
    {
        parent::__construct(PriceableInterface::class, $data);
    }
}