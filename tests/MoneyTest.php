<?php

namespace tests;

use maxlzp\household\exceptions\CurrencyMismatchException;
use maxlzp\household\exceptions\SubtractGreaterMoneyValueException;
use maxlzp\household\Money;
use PHPUnit\Framework\TestCase;

class MoneyTest extends TestCase
{
    /**
     * @test
     */
    public function shouldStoreCurrencyInUpprcase()
    {
        $currency = 'usd';
        $expectedCurrency = \mb_strtoupper($currency);
        $money = new Money(10, $currency);

        $this->assertEquals($expectedCurrency, $money->getCurrency());
    }

    /**
     * @test
     */
    public function shouldAddMoney()
    {
        $usd1 = new Money(100, 'usd');
        $usd2 = new Money(100, 'usd');

        $usd3 = $usd1->add($usd2);

        $this->assertEquals($usd1->getCurrency(), $usd3->getCurrency());
        $this->assertEquals(200, $usd3->getValue());
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenAddingMoneyWithDifferentCurrencies()
    {
        $this->expectException(CurrencyMismatchException::class);

        $usd1 = new Money(100, 'usd');
        $usd2 = new Money(100, 'eur');

        $usd3 = $usd1->add($usd2);
    }

    /**
     * @test
     */
    public function shouldSubtractMoney()
    {
        $usd1 = new Money(100, 'usd');
        $usd2 = new Money(100, 'usd');

        $usd3 = $usd1->subtract($usd2);

        $this->assertEquals($usd1->getCurrency(), $usd3->getCurrency());
        $this->assertEquals(0, $usd3->getValue());
    }

    /**
     * @test
     */
    public function shouldThrowExceptionWhenSubtractingMoneyWithDifferentCurrencies()
    {
        $this->expectException(CurrencyMismatchException::class);

        $usd1 = new Money(100, 'usd');
        $usd2 = new Money(100, 'eur');

        $usd3 = $usd1->subtract($usd2);
    }
    /**
     * @test
     */
    public function shouldThrowExceptionWhenSubtractingLargerMoneyValue()
    {
        $this->expectException(SubtractGreaterMoneyValueException::class);

        $usd1 = new Money(100, 'usd');
        $usd2 = new Money(200, 'usd');

        $usd3 = $usd1->subtract($usd2);
    }

    /**
     * @test
     * @dataProvider multiplyDataProvider
     */
    public function shouldMultilpyByAmount($money, $multiplier, $expected)
    {
        $usd = new Money($money, 'usd');
        $this->assertEquals($expected, $usd->multiply($multiplier)->getValue());
    }

    public function multiplyDataProvider()
    {
        return [
            [123, 0, 0],
            [123, 1, 123],
            [123, 1.5, \round(123 * 1.5)],
            [123, 1.125, \round(123 * 1.125)],
            [123, .8, \round(123 * .8)],
        ];
    }
}
