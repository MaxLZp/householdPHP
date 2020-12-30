<?php

namespace maxlzp\household\billing\tariff;

use maxlzp\household\billing\PriceableCollection;
use maxlzp\household\billing\usage\UsageValue;
use maxlzp\household\Money;

/**
 * Class Composite
 * @package maxlzp\household\billing\tariff
 */
class Composite extends Tariff
{
    /**
     * @var PriceableCollection
     */
    protected $children;

    /**
     * Composite constructor.
     *
     * @param TariffId $id
     * @param string $title
     * @param PriceableCollection|null $children
     * @param TariffId|null $parentId
     */
    public function __construct(TariffId $id, string $title, PriceableCollection $children = null, TariffId $parentId = null)
    {
        parent::__construct($id);
        $this->title = $title;
        $this->children = \is_null($children) ? new PriceableCollection() : $children;
        $this->parentId = $parentId;
    }

    /**
     * Gets PriceableCollection of Composite's children
     *
     * @return PriceableCollection
     */
    public function getChildren(): PriceableCollection
    {
        return new PriceableCollection($this->children->toArray());
    }

    /**
     * Get price for usage
     *
     * @param UsageValue $usage
     *
     * @return mixed
     * @throws \maxlzp\household\exceptions\CurrencyMismatchException
     */
    public function getPriceFor(UsageValue $usage): Money
    {
        $children = $this->getChildren();
        $result = new Money(
            0,
            \count($children) > 0
                ? $children->first()->getCost()->getCurrency()
                : ''
        );
        foreach ($children as $priceable) {
            $result = $result->add($priceable->getPriceFor($usage));
        }
        return $result;
    }
}