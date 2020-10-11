<?php

namespace maxlzp\household\accounting;

use maxlzp\household\exceptions\InvalidMeterReadingsOrderException;

/**
 * Class Usage
 *
 * @package maxlzp\household\accounting
 */
class Usage
{
    /**
     * @var MeterReading
     */
    private $current;

    /**
     * @var MeterReading
     */
    private $previous;

    /**
     * @var MeterParameters
     */
    private $meterParameters;

    /**
     * @param MeterReading    $current
     * @param MeterReading    $previous
     * @param MeterParameters $meterParameters
     *
     * @return Usage
     *
     * @throws InvalidMeterReadingsOrderException
     */
    public static function createFor(
        MeterReading $current,
        MeterReading $previous,
        MeterParameters $meterParameters
    ): self {
        self::guardInvalidReadingsOrder($current, $previous);
        return new self($current, $previous, $meterParameters);
    }

    /**
     * Usage constructor.
     *
     * @param MeterReading    $current
     * @param MeterReading    $previous
     * @param MeterParameters $meterParameters
     *
     */
    protected function __construct(
        MeterReading $current,
        MeterReading $previous,
        MeterParameters $meterParameters
    ) {
        $this->current = $current;
        $this->previous = $previous;
        $this->meterParameters = $meterParameters;
    }

    /**
     * Current MeterReading
     *
     * @return MeterReading
     */
    public function getCurrent(): MeterReading
    {
       return clone $this->current;
    }

    /**
     * Meter parameters
     *
     * @return MeterParameters
     */
    public function getMeterParameters(): MeterParameters
    {
       return clone $this->meterParameters;
    }

    /**
     * Previous MeterReading
     *
     * @return MeterReading
     */
    public function getPrevious(): MeterReading
    {
        return clone $this->previous;
    }

    /**
     * Calculate Usage value
     *
     * @return float
     *
     * @throws InvalidMeterReadingsOrderException
     */
    public function getValue(): float
    {
        return $this->getValueCalculator()->calculate();
    }

    /**
     * Get valid UsageValueCalculator
     *
     * @return UsageValueCalculatorInterface
     *
     * @throws InvalidMeterReadingsOrderException
     */
    private function getValueCalculator(): UsageValueCalculatorInterface
    {
        if ($this->isReadingsOverflow()) {
            return new UsageValueOverflowCalculator($this);
        };
        return new UsageValueCalculator($this);
    }

    /**
     * Guards against invalid order of meter readings supplied.
     * Order is being checked by reading's 'takenAt' date.
     *
     * @param MeterReading $current
     * @param MeterReading $previous
     *
     * @throws InvalidMeterReadingsOrderException
     */
    private static function guardInvalidReadingsOrder(MeterReading $current, MeterReading $previous)
    {
        if ($current->getTakenAt() < $previous->getTakenAt())
        {
            throw new InvalidMeterReadingsOrderException();
        }
    }

    /**
     * Checks if reading are overflown over meter's maximum value
     *
     * @return bool
     */
    private function isReadingsOverflow(): bool
    {
        return $this->previous->getValue() > $this->current->getValue();
    }
}