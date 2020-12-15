<?php

namespace maxlzp\household\billing\usage;

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
     * @param Usage $usage
     *
     * @return UsageValue
     */
    public function calculate(Usage $usage): UsageValue;
}