<?php

namespace maxlzp\household\accounting\household;

use maxlzp\household\accounting\meter\Meter;
use maxlzp\household\accounting\meter\MeterId;
use maxlzp\household\accounting\meter\MeterParameters;
use maxlzp\household\entity\Entity;

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
     * @param HouseholdId $id
     * @param string      $title
     */
    public function __construct(HouseholdId $id, string $title)
    {
        parent::__construct($id);
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
     * @param MeterId $meterId
     * @param string $title
     * @param \DateTimeImmutable $registrationDate
     * @param MeterParameters $parameters
     *
     * @return Meter
     */
    public function registerMeter(
        MeterId $meterId,
        string $title,
        \DateTimeImmutable $registrationDate,
        MeterParameters $parameters
    ): Meter {
        return $this->createMeter($meterId, $title, $registrationDate, $parameters);
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
     * @param MeterId $newMeterId
     * @param string $title
     * @param \DateTimeImmutable $registrationDate
     * @param MeterParameters $parameters
     *
     * @return Meter
     */
    public function replaceMeter(
        Meter $oldMeter,
        MeterId $newMeterId,
        string $title,
        \DateTimeImmutable $registrationDate,
        MeterParameters $parameters
    ): Meter {
        $oldMeter->replace($registrationDate);
        return $this->registerMeter($newMeterId, $title, $registrationDate, $parameters);
    }

    /**
     * Create new Meter for household
     *
     * @param MeterId $meterId
     * @param string $title
     * @param \DateTimeImmutable $registrationDate
     * @param MeterParameters $parameters
     *
     * @return Meter
     */
    private function createMeter(
        MeterId $meterId,
        string $title,
        \DateTimeImmutable $registrationDate,
        MeterParameters $parameters
    ): Meter {
        return new Meter(
            $meterId,
            $this->getId(),
            $title,
            $registrationDate,
            $parameters
        );
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