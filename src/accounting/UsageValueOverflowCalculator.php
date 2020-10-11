<?php

namespace maxlzp\household\accounting;

use maxlzp\household\exceptions\InvalidMeterReadingsOrderException;

/**
 * Class UsageValueOverflowCalculator
 *
 * @package maxlzp\household\accounting
 */
class UsageValueOverflowCalculator extends UsageValueCalculator
    implements UsageValueCalculatorInterface
{

    /**
     * UsageValueOverflowCalculator constructor.
     *
     * @param Usage $usage
     *
     * @throws \maxlzp\household\exceptions\InvalidMeterReadingsOrderException
     */
    public function __construct(Usage $usage)
    {
        parent::__construct($usage);
    }

    /**
     * Calculate usage value
     *
     * @return float
     */
    public function calculate(): float
    {
        return $this->usage->getCurrent()->getValue()
            + ($this->usage->getMeterParameters()->getMaximumValue() - $this->usage->getPrevious()->getValue());
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