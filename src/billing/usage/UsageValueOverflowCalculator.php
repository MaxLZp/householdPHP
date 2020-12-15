<?php

namespace maxlzp\household\billing\usage;

use maxlzp\household\exceptions\InvalidMeterReadingsOrderException;

/**
 * Class UsageValueOverflowCalculator
 *
 * @package maxlzp\household\accounting
 */
class UsageValueOverflowCalculator implements UsageValueCalculatorInterface
{

    /**
     * Calculate usage value
     *
     * @param Usage $usage
     *
     * @return UsageValue
     */
    public function calculate(Usage $usage): UsageValue
    {
        return new UsageValue(
            $usage->getCurrent()->getValue()
            + ($usage->getMeterParameters()->getMaximumValue() - $usage->getPrevious()->getValue())
        );
    }

    /**
     * Guards against invalid meter readings order
     *
     * @param Usage $usage
     *
     * @throws InvalidMeterReadingsOrderException
     */
    protected function guardInvalidMeterReadingOrder(Usage $usage)
    {
        if ($usage->getPrevious()->getValue() < $usage->getCurrent()->getValue())
            throw new InvalidMeterReadingsOrderException();
    }
}