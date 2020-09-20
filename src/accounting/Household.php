<?php

namespace maxlzp\household\accounting;

use maxlzp\household\Entity;
use maxlzp\household\Id;

/**
 * Class Household
 *
 * @package maxlzp\household\accounting
 */
class Household extends Entity
{
    /**
     * Household title
     *
     * @var HouseholdTitle
     */
    private $title;

    /**
     * Household constructor.
     *
     * @param string      $title
     * @param string|null $id
     */
    public function __construct(string $title, string $id = null)
    {
        parent::__construct(new Id($id));
        $this->resetTitle($title);
    }

    /**
     * Check if this household is equal to other
     *
     * @param Household $other
     *
     * @return bool true - if household is equal to other; false - otherwise
     */
    public function equals(Household $other): bool
    {
        return $this->getId()->equals($other->getId())
            && $this->getTitle()->equals($other->getTitle());
    }

    /**
     * Returns Household's title
     *
     * @return HouseholdTitle
     */
    public function getTitle(): HouseholdTitle
    {
       return $this->title;
    }

    /**
     * Register new Meter for household
     *
     * @return Meter
     */
    public function registerMeter(): Meter
    {
        return $this->createMeter();
    }

    /**
     * Rename household
     *
     * @param string $newTitle
     */
    public function rename(string $newTitle): void
    {
        $this->resetTitle($newTitle);
    }

    /**
     * Replace meter with new one
     *
     * @param Meter $oldMeter
     *
     * @return Meter
     */
    public function replaceMeter(Meter $oldMeter): Meter
    {
        $oldMeter->replace();
    }

    /**
     * Create new Meter for household
     *
     * @return Meter
     */
    private function createMeter(): Meter
    {
        return new Meter($this->getId());
    }

    /**
     * Reset household title
     *
     * @param string $newTitle
     */
    private function resetTitle(string $newTitle): void
    {
        $this->title = new HouseholdTitle($newTitle);
    }
}