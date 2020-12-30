<?php

namespace maxlzp\household\accounting\reading;

use maxlzp\household\accounting\meter\MeterId;
use maxlzp\household\entity\Entity;

/**
 * Class MeterReading
 *
 * @package maxlzp\household\accounting
 */
class MeterReading extends Entity
{

    /**
     * @var MeterId
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
     * @param MeterId            $meterId
     * @param \DateTimeImmutable $takenAt
     * @param float              $value
     * @param MeterReadingId     $id
     */
    public function __construct(
        MeterId $meterId,
        \DateTimeImmutable $takenAt,
        float $value,
        MeterReadingId $id = null)
    {
        parent::__construct(new MeterReadingId($id));
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
     * @return MeterId
     */
    public function getMeterId(): MeterId
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