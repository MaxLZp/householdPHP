<?php

namespace maxlzp\household\accounting;

use maxlzp\household\Entity;
use maxlzp\household\exceptions\MeterReadingValueExceedsMaxMtereValueException;
use maxlzp\household\Id;

/**
 * Class Meter
 *
 * @package maxlzp\household\accounting
 */
class Meter extends Entity
{
    /**
     * @var Id
     */
    private $householdId;

    /**
     * @var \DateTimeImmutable
     */
    private $registrationDate;

    /**
     * @var \DateTimeImmutable
     */
    private $replacementDate;

    /**
     * @var MeterParameters
     */
    private $parameters;

    /**
     * @var MeterTitle
     */
    private $title;

    /**
     * Meter constructor.
     *
     * @param Id             $householdId
     * @param string             $title
     * @param \DateTimeImmutable $registrationDate
     * @param MeterParameters    $parameters
     * @param \DateTimeImmutable $replacementDate
     * @param string|null        $id
     *
     */
    public function __construct(
        Id $householdId,
        string $title,
        \DateTimeImmutable $registrationDate,
        MeterParameters $parameters,
        \DateTimeImmutable $replacementDate = null,
        string $id = null
    ) {
        parent::__construct(new Id($id));

        $this->householdId = $householdId;
        $this->parameters = $parameters;
        $this->registrationDate = $registrationDate;
        $this->replacementDate = $replacementDate;
        $this->title = $this->createTitle($title);
    }

    /**
     * Check if meter is equal to other
     *
     * @param Meter $other
     *
     * @return bool
     */
    public function equals(Meter $other): bool
    {
        return $this->getId()->equals($other->getId())
            && $this->getHouseholdId()->equals($other->getHouseholdId())
            && $this->getTitle()->equals($other->getTitle());
    }

    /**
     * Returns Id of household meter is bound to
     *
     * @return Id
     */
    public function getHouseholdId(): Id
    {
        return $this->householdId;
    }

    /**
     * @return MeterParameters
     */
    public function getParameters(): MeterParameters
    {
        return clone $this->parameters;
    }

    /**
     * Return Meter's registration date
     *
     * @return \DateTimeImmutable
     */
    public function getRegistrationDate(): \DateTimeImmutable
    {
        return $this->registrationDate;
    }

    /**
     * Return Meter's replacement date
     *
     * @return null|\DateTimeImmutable
     */
    public function getReplacementDate(): ?\DateTimeImmutable
    {
        return $this->replacementDate;
    }

    /**
     * Meter is replaced or not
     *
     * @return bool
     */
    public function isReplaced(): bool
    {
        return !\is_null($this->replacementDate);
    }

    /**
     * Returns meter's title
     *
     * @return MeterTitle
     */
    public function getTitle(): MeterTitle
    {
        return $this->title;
    }

    /**
     * Reset number of meter digits
     *
     * @param int $digits
     */
    public function resetDigits(int $digits): void
    {
        $this->parameters->setDigits($digits);
    }

    /**
     * @param string $newTitle
     */
    public function rename(string $newTitle): void
    {
        $this->title = $this->createTitle($newTitle);
    }

    /**
     * Replace meter
     *
     * @param \DateTimeImmutable $replacedAt
     */
    public function replace(\DateTimeImmutable $replacedAt): void
    {
       $this->replacementDate = $replacedAt;
    }

    /**
     * Reset meter precision
     *
     * @param int $precision
     */
    public function resetPrecision(int $precision): void
    {
        $this->parameters->setPrecision($precision);
    }

    /**
     * Create new MeterReading
     *
     * @param \DateTimeImmutable $takenAt
     * @param float              $value
     *
     * @return MeterReading
     *
     * @throws MeterReadingValueExceedsMaxMtereValueException
     */
    public function takeReading(
        \DateTimeImmutable $takenAt,
        float $value
    ): MeterReading {
        $this->guardReadingValueExceedsMaxMeterValue($value);
        return new MeterReading(
            $this->getId(),
            $takenAt,
            $value
        );
    }

    /**
     * Create title
     *
     * @param string $newTitle
     *
     * @return MeterTitle
     */
    private function createTitle(string $newTitle): MeterTitle
    {
        return new MeterTitle($newTitle);
    }

    /**
     * Guards against  invalid reading value - value that exceeds meter's maximum value
     *
     * @param float $value
     *
     * @throws MeterReadingValueExceedsMaxMtereValueException
     */
    private function guardReadingValueExceedsMaxMeterValue(float $value)
    {
        if ($value > $this->getParameters()->getMaximumValue())
            throw new MeterReadingValueExceedsMaxMtereValueException("MeterReading value({$value}) cannot be grater than {$this->getParameters()->getMaximumValue()}");
    }
}