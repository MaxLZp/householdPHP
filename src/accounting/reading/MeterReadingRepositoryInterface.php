<?php

namespace maxlzp\household\accounting\reading;

use maxlzp\household\accounting\meter\MeterId;
use maxlzp\household\accounting\reading\exceptions\MeterReadingNotFoundException;

/**
 * Interface MeterReadingRepositoryInterface
 * @package maxlzp\household\accounting\reading
 */
interface MeterReadingRepositoryInterface
{
    /**
     * Add the meter reading to repository
     *
     * @param MeterReading $reading
     */
    function add(MeterReading $reading): void;

    /**
     * Get all meter reading
     *
     * @return MeterReadingCollection
     */
    function getAll(): MeterReadingCollection;

    /**
     * Get all meter readings read at meter specified
     *
     * @param MeterId $meterId
     *
     * @return MeterReadingCollection
     */
    function getFromMeter(MeterId $meterId): MeterReadingCollection;

    /**
     * Get meter readings which has benn read at date interval specified
     *
     * @param \DateTimeImmutable $from
     * @param \DateTimeImmutable $to
     *
     * @return MeterReadingCollection
     */
    function getReadBetween(\DateTimeImmutable $from, \DateTimeImmutable $to): MeterReadingCollection;

    /**
     * Returns MeterReading with $id specified
     *
     * @param MeterId $id
     *
     * @return MeterReading
     *
     * @throws MeterReadingNotFoundException
     */
    function meterReadingOfId(MeterId $id): MeterReading;

    /**
     * Generate MeterReadingId
     *
     * @return MeterReadingId
     */
    function nextId(): MeterReadingId;

    /**
     * Remove the meter reading from repository
     *
     * @param MeterReading $reading
     */
    function remove(MeterReading $reading): void;

    /**
     * Update the meter reading specified
     *
     * @param MeterReading $reading
     */
    function update(MeterReading $reading): void;
}