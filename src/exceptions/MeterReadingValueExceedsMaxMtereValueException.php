<?php

namespace maxlzp\household\exceptions;

class MeterReadingValueExceedsMaxMtereValueException extends \Exception
{

    /**
     * MeterReadingValueExceedsMaxMtereValueException constructor.
     */
    public function __construct(string $message)
    {
        parent::__construct($message);
    }
}