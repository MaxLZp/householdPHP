<?php


namespace maxlzp\household;

use maxlzp\household\exceptions\InvalidRangeMargins;

/**
 * Class Range
 * @package maxlzp\household
 */
class Range
{
    /**
     * @var float
     */
    private $start;
    /**
     * @var float
     */
    private $end;

    /**
     * Range constructor.
     * @param float $start
     * @param float $end
     *
     * @throws InvalidRangeMargins
     */
    public function __construct(float $start, float $end)
    {
        $this->guardInvalidMarginsOrder($start, $end);
        $this->start = $start;
        $this->end = $end;
    }

    /**
     * Range ending value
     *
     * @return float
     */
    public function getEnd(): float
    {
        return $this->end;
    }

    /**
     * Range starting value
     *
     * @return float
     */
    public function getStart(): float
    {
        return $this->start;
    }

    /**
     * Range width
     *
     * @return float
     */
    public function getWidth(): float
    {
        return $this->getEnd() - $this->getStart();
    }

    /**
     * Range starting value must not be greater than it's ending value
     *
     * @param float $start
     * @param float $end
     *
     * @throws InvalidRangeMargins
     */
    protected function guardInvalidMarginsOrder(float $start, float $end)
    {
        if ($start > $end) {
            throw new InvalidRangeMargins(
                sprintf("Range starting value(%.2d) cannot be greater than it's ending value(%.2d)", $start, $end)
            );
        }
    }
}