<?php

namespace maxlzp\household\billing\tariff;

use maxlzp\household\accounting\UsageValue;
use maxlzp\household\billing\PriceableInterface;
use maxlzp\household\Entity;
use maxlzp\household\Id;
use maxlzp\household\Money;

/**
 * Class UsageValueBased
 * @package maxlzp\household\billing\tariff
 */
class UsageValueBased extends Entity implements PriceableInterface
{
    use ParentTrait;
    use TariffTitleTrait;
    use CostTrait;

    /**
     * UsageValueBased constructor.
     * @param string $title
     * @param Money $cost
     * @param Id|null $parentId
     * @param Id|null $id
     */
    public function __construct(string $title, Money $cost, Id $parentId = null, Id $id = null)
    {
        parent::__construct($id);
        $this->cost = $cost;
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
            $this->getCost()->multiply($usage->getValue())->getValue(),
            $this->getCost()->getCurrency()
        );
    }

}