<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Model;


use LSB\UtilityBundle\Helper\ValueHelper;
use LSB\UtilityBundle\Value\Value;
use Money\Money;

class Price
{
    protected ?int $price = null;
    protected ?int $netPrice = null;
    protected ?int $grossPrice = null;
    protected ?int $baseNetPrice = null;
    protected ?int $baseGrossPrice = null;
    protected ?int $vat = null;
    protected ?string $currencyIsoCode = null;

    /**
     * @param int|null $price
     * @param int|null $netPrice
     * @param int|null $grossPrice
     * @param int|null $baseNetPrice
     * @param int|null $baseGrossPrice
     * @param int|null $vat
     * @param string|null $currencyIsoCode
     */
    public function __construct(
        ?int    $price,
        ?int    $netPrice,
        ?int    $grossPrice,
        ?int    $baseNetPrice,
        ?int    $baseGrossPrice,
        ?int    $vat,
        ?string $currencyIsoCode
    ) {
        $this->price = $price;
        $this->netPrice = $netPrice;
        $this->grossPrice = $grossPrice;
        $this->baseNetPrice = $baseNetPrice;
        $this->baseGrossPrice = $baseGrossPrice;
        $this->vat = $vat;
        $this->currencyIsoCode = $currencyIsoCode;
    }

    /**
     * @param bool $useMoney
     * @return Money|int|null
     */
    public function getPrice(bool $useMoney = false): Money|int|null
    {
        return $useMoney ? ValueHelper::intToMoney($this->price, $this->currencyIsoCode) : $this->price;
    }

    /**
     * @param bool $useMoney
     * @return Money|int|null
     */
    public function getNetPrice(bool $useMoney = false): Money|int|null
    {
        return $useMoney ? ValueHelper::intToMoney($this->netPrice, $this->currencyIsoCode) : $this->netPrice;
    }

    /**
     * @param bool $useMoney
     * @return Money|int|null
     */
    public function getGrossPrice(bool $useMoney = false): Money|int|null
    {
        return $useMoney ? ValueHelper::intToMoney($this->grossPrice, $this->currencyIsoCode) : $this->grossPrice;
    }

    /**
     * @param bool $useMoney
     * @return Money|int|null
     */
    public function getBaseNetPrice(bool $useMoney = false): Money|int|null
    {
        return $useMoney ? ValueHelper::intToMoney($this->baseNetPrice, $this->currencyIsoCode) : $this->baseNetPrice;
    }

    /**
     * @param bool $useMoney
     * @return Money|int|null
     */
    public function getBaseGrossPrice(bool $useMoney = false): Money|int|null
    {
        return $useMoney ? ValueHelper::intToMoney($this->baseGrossPrice, $this->currencyIsoCode) : $this->baseGrossPrice;
    }

    /**
     * @param bool $useValue
     * @return Value|int|null
     */
    public function getVat(bool $useValue = false): Value|int|null
    {
        return $useValue ? ValueHelper::intToValue($this->vat, Value::UNIT_PERCENTAGE) : $this->vat;
    }

    /**
     * @return string|null
     */
    public function getCurrencyIsoCode(): ?string
    {
        return $this->currencyIsoCode;
    }

}
