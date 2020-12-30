<?php

namespace maxlzp\household\entity;

/**
 * Class IdTrait
 * @package maxlzp\household\entity
 */
abstract class Id
{

    /**
     * Check if two Id's are equal
     *
     * @param Id $other
     *
     * @return bool
     */
    abstract public function equals(Id $other): bool;

    /**
     * Id value
     *
     * @var mixed
     */
    private $id;

    /**
     * Id constructor.
     * @param $id
     */
    public function __construct($id)
    {
        $this->id = $id;
    }

    /**
     * Id value
     *
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


}