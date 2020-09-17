<?php

namespace maxlzp\household;

/**
 * Class Entity
 *
 * @package maxlzp\household\entities
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
     * @param Id $id
     */
    public function __construct(Id $id = null)
    {
        $this->id = ($id === null) ? new Id : $id;
    }

    /**
     * Returns Entity's Id
     *
     * @return Id
     */
    public function getId(): Id
    {
        return $this->id;
    }

    /**
     * Checks if two entities are equal
     *
     * @param Entity $other
     *
     * @return bool
     */
    public function equals(Entity $other): bool
    {
        return $this->getId()->equals($other->getId());
    }
}