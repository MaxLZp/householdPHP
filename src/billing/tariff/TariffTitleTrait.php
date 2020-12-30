<?php

namespace maxlzp\household\billing\tariff;

/**
 * Trait TariffTitleTrait
 * @package maxlzp\household\billing\tariff
 */
trait TariffTitleTrait
{
    /**
     * @var TariffTitle
     */
    protected $title;

    /**
     * @return TariffTitle
     */
    public function getTitle(): TariffTitle
    {
        return $this->title;
    }

    /**
     * Change tariff's title
     *
     * @param TariffTitle $newTitle
     */
    public function rename(string $newTitle): TariffTitle
    {
        $this->title = new TariffTitle($newTitle);
    }
}