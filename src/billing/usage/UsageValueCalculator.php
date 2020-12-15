<?php

namespace maxlzp\household\billing\usage;

use maxlzp\household\exceptions\InvalidMeterReadingsOrderException;

/**
 * Class UsageValueCalculator
 *
 * @package maxlzp\household\accounting
 */
class UsageValueCalculator implements UsageValueCalculatorInterface
{
    /**
     * Calculate usage value
     *
     * @param Usage $usage
     *
     * @return UsageValue
     *
     * @throws InvalidMeterReadingsOrderException
     */
    public function calculate(Usage $usage): UsageValue
    {
        static::guardInvalidMeterReadingOrder($usage);
        return new UsageValue(
            $usage->getCurrent()->getValue() - $usage->getPrevious()->getValue()
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
        if ($usage->getCurrent()->getValue() < $usage->getPrevious()->getValue())
            throw new InvalidMeterReadingsOrderException();
    }
}