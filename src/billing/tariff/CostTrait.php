<?php

namespace maxlzp\household\billing\tariff;

use maxlzp\household\Money;

/**
 * Trait CostTrait
 * @package maxlzp\household\billing\tariff
 */
trait CostTrait
{

    /**
     * @var Money
     */
    private $cost;

    /**
     * @return Money
     */
    public function getCost(): Money
    {
        return $this->cost;
    }
}