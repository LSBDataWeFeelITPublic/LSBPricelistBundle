<?php
declare(strict_types=1);


namespace LSB\PricelistBundle\Model;


class Price
{
    protected ?float $price;
    protected ?float $netPrice;
    protected ?float $grossPrice;
    protected ?float $baseNetPrice;
    protected ?float $baseGrossPrice;
    protected ?float $vat;
    protected ?string $currencyCode;

    /**
     * Price constructor.
     * @param float|null $price
     * @param float|null $netPrice
     * @param float|null $grossPrice
     * @param float|null $baseNetPrice
     * @param float|null $baseGrossPrice
     * @param float|null $vat
     * @param string|null $currencyCode
     */
    public function __construct(
        ?float $price,
        ?float $netPrice,
        ?float $grossPrice,
        ?float $baseNetPrice,
        ?float $baseGrossPrice,
        ?float $vat,
        ?string $currencyCode
    ) {
        $this->price = $price;
        $this->netPrice = $netPrice;
        $this->grossPrice = $grossPrice;
        $this->baseNetPrice = $baseNetPrice;
        $this->baseGrossPrice = $baseGrossPrice;
        $this->vat = $vat;
        $this->currencyCode = $currencyCode;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @return float|null
     */
    public function getNetPrice(): ?float
    {
        return $this->netPrice;
    }

    /**
     * @return float|null
     */
    public function getGrossPrice(): ?float
    {
        return $this->grossPrice;
    }

    /**
     * @return float|null
     */
    public function getBaseNetPrice(): ?float
    {
        return $this->baseNetPrice;
    }
    
    /**
     * @return float|null
     */
    public function getBaseGrossPrice(): ?float
    {
        return $this->baseGrossPrice;
    }

    /**
     * @return float|null
     */
    public function getVat(): ?float
    {
        return $this->vat;
    }

    /**
     * @return string|null
     */
    public function getCurrencyCode(): ?string
    {
        return $this->currencyCode;
    }


}
