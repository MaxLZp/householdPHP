<?php

namespace maxlzp\household\billing;

use maxlzp\household\accounting\UsageValue;
use maxlzp\household\Money;

/**
 * Interface PriceableInterface
 * @package maxlzp\household\billing
 */
interface PriceableInterface
{
    /**
     * Get price for usage
     *
     * @param UsageValue $usage
     *
     * @return mixed
     */
    public function getPriceFor(UsageValue $usage): Money;
}