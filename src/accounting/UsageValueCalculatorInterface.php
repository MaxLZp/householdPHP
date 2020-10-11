<?php

namespace maxlzp\household\accounting;

/**
 * Interface UsageValueCalculatorInterface
 *
 * @package maxlzp\household\accounting
 */
interface UsageValueCalculatorInterface
{
    /**
     * Calculate usage value
     *
     * @return float
     */
    public function calculate(): float;
}