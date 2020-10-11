<?php

namespace maxlzp\household\exceptions;

/**
 * Class InvalidMeterReadingsOrderException
 *
 * @package maxlzp\household\exceptions
 */
class InvalidMeterReadingsOrderException extends \Exception
{
    /**
     * InvalidMeterReadingsOrderException constructor.
     *
     * @param string $message
     */
    public function __construct(string $message = 'Invalid MeterReading\'s order')
    {
        parent::__construct($message);
    }
}