<?php


namespace maxlzp\household\entities;

use Ramsey\Uuid\Uuid;

/**
 * Class Id
 * Entity identity
 *
 * @package maxlzp\household\entities
 */
class Id
{

    /**
     * Id value
     *
     * @var string|null
     */
    private $id;

    /**
     * Id constructor.
     *
     * @param string|null $id
     */
    public function __construct(string $id = null)
    {
        $this->id = $id === null ? Uuid::uuid4() : $id;
    }

    /**
     * Id value
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Check if two Id's are equal
     *
     * @param Id $other
     *
     * @return bool
     */
    public function equals(Id $other): bool
    {
        if ($this === $other) return true;
        return \strcmp($this->getId(), $other->getId()) === 0;
    }
}