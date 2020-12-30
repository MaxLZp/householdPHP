<?php

namespace maxlzp\household;

/**
 * Trait TitleTrait
 * @package maxlzp\household
 */
trait TitleTrait
{
    /**
     * @var string
     */
    private $title;

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

}