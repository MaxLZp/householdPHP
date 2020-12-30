<?php

namespace maxlzp\household\billing\tariff;

use maxlzp\household\billing\usage\UsageValue;
use maxlzp\household\Money;
use maxlzp\household\Range;

/**
 * Class UsageValueRangeBased
 * @package maxlzp\household\billing\tariff
 */
class UsageValueRangeBased extends Tariff
{
    use CostTrait;

    /**
     * @var Range
     */
    private $range;

    /**
     * UsageValueRangeBased constructor.
     *
     * @param TariffId $id
     * @param string $title
     * @param Money $cost
     * @param Range $range
     * @param TariffId|null $parentId
     */
    public function __construct(TariffId $id, string $title, Money $cost, Range $range, TariffId $parentId = null)
    {
        parent::__construct($id);
        $this->cost = $cost;
        $this->range = $range;
        $this->title = $title;
        $this->parentId = $parentId;
    }

    /**
     * Get price for usage
     *
     * @param UsageValue $usage
     *
     * @return mixed
     */
    public function getPriceFor(UsageValue $usage): Money
    {
        return new Money(
            $this->getCost()->multiply(
                $usage->within($this->getRange())->getValue()
            )->getValue(),
            $this->getCost()->getCurrency()
        );
    }

    /**
     * @return Range
     */
    public function getRange(): Range
    {
        return $this->range;
    }
}