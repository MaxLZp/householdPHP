<?php

namespace maxlzp\household\billing\tariff;


use maxlzp\household\TitleTrait;

/**
 * Class TariffTitle
 * @package maxlzp\household\billing\tariff
 */
class TariffTitle
{
    use TitleTrait;

    /**
     * TariffTitle constructor.
     * @param string $title
     */
    public function __construct(string $title)
    {
        $this->title = $title;
    }
}