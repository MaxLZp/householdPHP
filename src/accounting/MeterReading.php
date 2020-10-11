<?php

namespace maxlzp\household\accounting;

use maxlzp\household\Entity;
use maxlzp\household\Id;

/**
 * Class MeterReading
 *
 * @package maxlzp\household\accounting
 */
class MeterReading extends Entity
{

    /**
     * @var Id
     */
    private $meterId;

    /**
     * @var \DateTimeImmutable
     */
    private $takenAt;

    /**
     * @var float
     */
    private $value;

    /**
     * MeterReading constructor.
     *
     * @param Id                 $meterId
     * @param \DateTimeImmutable $takenAt
     * @param float              $value
     * @param Id                 $id
     */
    public function __construct(
        Id $meterId,
        \DateTimeImmutable $takenAt,
        float $value,
        Id $id = null)
    {
        parent::__construct($id);
        $this->meterId = $meterId;
        $this->takenAt = $takenAt;
        $this->value = $value;
    }

    /**
     * Checks if Reading is equal to the other
     *
     * @param MeterReading $other
     *
     * @return bool
     */
    public function equals(MeterReading $other): bool
    {
        if ($this === $other) return true;
        return $this->getId()->equals($other->getId())
            && $this->getMeterId()->equals($other->getMeterId())
            && $this->getTakenAt() == $other->getTakenAt()
            && $this->getValue() === $other->getValue();
    }

    /**
     * @return Id
     */
    public function getMeterId(): Id
    {
        return $this->meterId;
    }

    /**
     * @return \DateTimeImmutable
     */
    public function getTakenAt(): \DateTimeImmutable
    {
        return $this->takenAt;
    }

    /**
     * @return float
     */
    public function getValue(): float
    {
        return $this->value;
    }
}