<?php

namespace maxlzp\household\accounting;

/**
 * Class MeterParameters
 *
 * @package maxlzp\household\accounting
 */
class MeterParameters
{
    /**
     * @var int
     */
    private $digits;

    /**
     * @var int
     */
    private $precision;

    /**
     * MeterParameters constructor.
     *
     * @param int $digits
     * @param int $precision
     */
    public function __construct(
        int $digits = 5,
        int $precision = 3
    ) {

        $this->digits = $digits;
        $this->precision = $precision;
    }

    /**
     * @return int
     */
    public function getDigits(): int
    {
        return $this->digits;
    }

    /**
     * Get Meter maximum value
     *
     * @return float
     */
    public function getMaximumValue(): float
    {
        return \pow(10, $this->getDigits());
    }

    /**
     * @return int
     */
    public function getPrecision(): int
    {
        return $this->precision;
    }

    /**
     * @param int $digits
     */
    public function setDigits(int $digits): void
    {
        $this->digits = $digits;
    }

    /**
     * @param int $precision
     */
    public function setPrecision(int $precision): void
    {
        $this->precision = $precision;
    }
}