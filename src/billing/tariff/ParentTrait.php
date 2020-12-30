<?php

namespace maxlzp\household\billing\tariff;


use maxlzp\household\entity\Id;

/**
 * Class ParentTrait
 * @package maxlzp\household\billing\tariff
 */
trait ParentTrait
{
    /**
     * @var Id
     */
    protected $parentId = null;

    /**
     * Id of parent Entity
     *
     * @return Id
     */
    public function getParentId(): Id
    {
        return $this->parentId;
    }
}