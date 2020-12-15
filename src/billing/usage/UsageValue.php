<?php


namespace maxlzp\household\billing\usage;

use maxlzp\household\Range;

/**
 * Class UsageValue
 * @package maxlzp\household\accounting
 */
class UsageValue
{
    /**
     * @var float
     */
    private $value;

    /**
     * UsageValue constructor.
     * @param float $value
     */
    public function __construct(float $value)
    {
        $this->value = $value;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }


    /**
     * Create a new new instance of UsageValue.
     * This instance is a portion of UsageValue that lies within range margins.
     *
     * @param Range $range
     *
     * @return UsageValue
     */
    public function within(Range $range): UsageValue
    {
        // ---->                     (value)
        // -------|==========|------ (range)
        //        start      end
        if ($range->getStart() > $this->getValue()) {
            return new UsageValue(0);
        }
        // ---------------------->   (value)
        // -------|==========|------ (range)
        //        start      end
        if ($range->getEnd() < $this->getValue()) {
            return new UsageValue($range->getWidth());
        }
        // ------------->            (value)
        // -------|==========|------ (range)
        //        start      end
        return new UsageValue($this->getValue() - $range->getStart());
    }
}