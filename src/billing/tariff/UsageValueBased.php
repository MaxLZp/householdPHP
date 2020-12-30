<?php

namespace maxlzp\household\billing\tariff;

use maxlzp\household\billing\PriceableInterface;
use maxlzp\household\billing\usage\UsageValue;
use maxlzp\household\entity\Entity;
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
     *
     * @param TariffId $id
     * @param string $title
     * @param Money $cost
     * @param TariffId|null $parentId
     */
    public function __construct(TariffId $id, string $title, Money $cost, TariffId $parentId = null)
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