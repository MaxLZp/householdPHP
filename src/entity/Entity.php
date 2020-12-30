<?php

namespace maxlzp\household\entity;

/**
 * Class Entity
 *
 * @package maxlzp\household\entity
 */
abstract class Entity
{
    /**
     * @var Id
     */
    private $id;

    /**
     * Entity constructor.
     *
     * @param mixed $id
     */
    public function __construct(Id $id)
    {
        $this->id = $id;
    }

    /**
     * Returns Entity's Id
     *
     * @return mixed
     */
    public function getId(): Id
    {
        return $this->id;
    }

}