<?php

namespace maxlzp\household\accounting;

use maxlzp\household\exceptions\InvalidMeterReadingsOrderException;

/**
 * Class UsageValueCalculator
 *
 * @package maxlzp\household\accounting
 */
class UsageValueCalculator implements UsageValueCalculatorInterface
{
    /**
     * @var Usage
     */
    protected $usage;

    /**
     * UsageValueCalculator constructor.
     *
     * @param Usage $usage
     *
     * @throws InvalidMeterReadingsOrderException
     */
    public function __construct(Usage $usage)
    {
        static::guardInvalidMeterReadingOrder($usage);
        $this->usage = $usage;
    }

    /**
     * Calculate usage value
     *
     * @return float
     */
    public function calculate(): float
    {
        return $this->usage->getCurrent()->getValue() - $this->usage->getPrevious()->getValue();
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