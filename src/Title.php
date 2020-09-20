<?php


namespace maxlzp\household;

/**
 * Class Title
 *
 * @package maxlzp\household
 */
abstract class Title
{
    /**
     * @var string
     */
    private $title;


    /**
     * Title constructor.
     *
     * @param string $title
     */
    public function __construct(string $title)
    {
        $this->title = $title;
    }

    /**
     * Returns title value
     *
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * Check if title is equal to other
     *
     * @param Title $other
     *
     * @return bool
     */
    public function equals(Title $other): bool
    {
        return strcmp($this->getTitle(), $other->getTitle()) === 0;
    }
}