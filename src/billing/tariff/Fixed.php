<?php

namespace maxlzp\household\billing\tariff;

use maxlzp\household\billing\PriceableInterface;
use maxlzp\household\billing\usage\UsageValue;
use maxlzp\household\Entity;
use maxlzp\household\Id;
use maxlzp\household\Money;

/**
 * Class Fixed
 * @package maxlzp\household\billing\tariff
 */
class Fixed extends Entity implements PriceableInterface
{
    use ParentTrait;
    use TariffTitleTrait;
    use CostTrait;

    /**
     * Fixed constructor.
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
        return $this->getCost();
    }

}