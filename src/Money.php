<?php


namespace maxlzp\household;

use maxlzp\household\exceptions\CurrencyMismatchException;
use maxlzp\household\exceptions\SubtractGreaterMoneyValueException;

/**
 * Class Money
 * @package maxlzp\household
 */
class Money
{
    /**
     * @var int
     */
    private $value;
    /**
     * @var string
     */
    private $currency;

    /**
     * Money constructor.
     * @param int $value
     * @param string $currency
     */
    public function __construct(int $value, string $currency)
    {
        $this->value = $value;
        $this->currency = \mb_strtoupper($currency);
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    /**
     * Sums two money values
     *
     * @param Money $other
     *
     * @return Money
     *
     * @throws CurrencyMismatchException
     */
    public function add(Money $other): Money
    {
        $this->guardCurrencyMismatch($other);
        return new Money($this->getValue() + $other->getValue(), $this->getCurrency());
    }

    /**
     * Multiply money by amount supplied
     *
     * @param float $multiplier
     *
     * @return Money
     */
    public function multiply(float $multiplier): Money
    {
        return new Money(\round($this->getValue() * $multiplier), $this->getCurrency());
    }


    /**
     * Subtracts money values
     *
     * @param Money $other
     *
     * @return Money
     *
     * @throws CurrencyMismatchException
     * @throws SubtractGreaterMoneyValueException
     */
    public function subtract(Money $other): Money
    {
        $this->guardCurrencyMismatch($other);
        $this->guardSubtractGreaterValue($other);
        return new Money($this->getValue() - $other->getValue(), $this->getCurrency());
    }

    /**
     * Gaurds against use of different currencies in a single operation
     *
     * @param Money $other
     *
     * @throws CurrencyMismatchException
     */
    private function guardCurrencyMismatch(Money $other)
    {
        if (\strcmp($this->getCurrency(), $other->getCurrency())) {
            throw new CurrencyMismatchException(
                sprintf('Cannot operate on money with different currencies: %s and %s', $this->getCurrency(), $other->getCurrency())
            );
        }
    }

    /**
     * @param Money $other
     *
     * @throws SubtractGreaterMoneyValueException
     */
    private function guardSubtractGreaterValue(Money $other)
    {
        if ($this->getValue() < $other->getValue()) {
            throw new SubtractGreaterMoneyValueException(
                sprintf('Cannot subtract %d from %d', $this->getValue(), $other->getValue())
            );
        }
    }
}