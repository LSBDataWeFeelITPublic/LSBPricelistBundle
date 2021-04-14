<?php
declare(strict_types=1);


namespace LSB\PricelistBundle\Model;


class Price
{
    protected ?float $netPrice;
    protected ?float $grossPrice;
    protected ?float $vat;
    protected ?string $currencyCode;

    /**
     * Price constructor.
     * @param float|null $netPrice
     * @param float|null $grossPrice
     * @param float|null $vat
     * @param string|null $currencyCode
     */
    public function __construct(
        ?float $netPrice,
        ?float $grossPrice,
        ?float $vat,
        ?string $currencyCode
    ) {
        $this->netPrice = $netPrice;
        $this->grossPrice = $grossPrice;
        $this->vat = $vat;
        $this->currencyCode = $currencyCode;
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
