<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Entity;

use LSB\UtilityBundle\Traits\IdTrait;
use Doctrine\ORM\Mapping as ORM;
use LSB\ProductBundle\Entity\ProductInterface;
use Doctrine\ORM\Mapping\MappedSuperclass;

/**
 * Use this class for joining price results from pricelist_product_list procedure
 *
 * Class PricelistProductList
 * @package LSB\PricelistBundle\Entity
 *
 * @MappedSuperclass
 */
class PricelistProductList implements PricelistProductListInterface
{
    use IdTrait;

    /**
     * @ORM\ManyToOne(targetEntity="LSB\ProductBundle\Entity\ProductInterface")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected ProductInterface $product;

    /**
     * @ORM\Column(type="decimal", nullable=false, scale=2)
     */
    protected float $price;

    /**
     * @ORM\Column(type="decimal", nullable=true, scale=2)
     */
    protected ?float $discount;

    /**
     * @ORM\Column(type="decimal", name="net_price", nullable=true, scale=2)
     */
    protected ?float $netPrice;

    /**
     * @ORM\Column(type="decimal", name="gross_price", nullable=true, scale=2)
     */
    protected ?float $grossPrice;

    /**
     * @ORM\Column(type="decimal", name="base_price", nullable=true, scale=2)
     */
    protected ?float $basePrice;

    /**
     * @ORM\Column(type="decimal", name="base_net_price", nullable=true, scale=2)
     */
    protected ?float $baseNetPrice;

    /**
     * @ORM\Column(type="decimal", name="base_gross_price", nullable=true, scale=2)
     */
    protected ?float $baseGrossPrice;

    /**
     * @ORM\Column(type="boolean", name="is_contractor_price", nullable=true)
     */
    protected ?bool $isContractorPrice;

    /**
     * @ORM\Column(type="decimal", nullable=true, scale=2)
     */
    protected ?float $vat;

    /**
     * @ORM\Column(type="string", name="positions_price_type", nullable=true, length="10")
     */
    protected ?string $positionsPriceType;

    /**
     * @ORM\Column(type="string", name="currency_code", nullable=true, length="20")
     */
    protected ?string $currencyCode;

    /**
     * @return ProductInterface
     */
    public function getProduct(): ProductInterface
    {
        return $this->product;
    }

    /**
     * @param ProductInterface $product
     * @return self
     */
    public function setProduct(ProductInterface $product): self
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return float
     */
    public function getPrice(): float
    {
        return $this->price;
    }

    /**
     * @param float $price
     * @return self
     */
    public function setPrice(float $price): self
    {
        $this->price = $price;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getDiscount(): ?float
    {
        return $this->discount;
    }

    /**
     * @param float|null $discount
     * @return self
     */
    public function setDiscount(?float $discount): self
    {
        $this->discount = $discount;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getNetPrice(): ?float
    {
        return $this->netPrice;
    }

    /**
     * @param float|null $netPrice
     * @return self
     */
    public function setNetPrice(?float $netPrice): self
    {
        $this->netPrice = $netPrice;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getGrossPrice(): ?float
    {
        return $this->grossPrice;
    }

    /**
     * @param float|null $grossPrice
     * @return self
     */
    public function setGrossPrice(?float $grossPrice): self
    {
        $this->grossPrice = $grossPrice;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getBasePrice(): ?float
    {
        return $this->basePrice;
    }

    /**
     * @param float|null $basePrice
     * @return self
     */
    public function setBasePrice(?float $basePrice): self
    {
        $this->basePrice = $basePrice;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getBaseNetPrice(): ?float
    {
        return $this->baseNetPrice;
    }

    /**
     * @param float|null $baseNetPrice
     * @return self
     */
    public function setBaseNetPrice(?float $baseNetPrice): self
    {
        $this->baseNetPrice = $baseNetPrice;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getBaseGrossPrice(): ?float
    {
        return $this->baseGrossPrice;
    }

    /**
     * @param float|null $baseGrossPrice
     * @return self
     */
    public function setBaseGrossPrice(?float $baseGrossPrice): self
    {
        $this->baseGrossPrice = $baseGrossPrice;
        return $this;
    }

    /**
     * @return bool|null
     */
    public function getIsContractorPrice(): ?bool
    {
        return $this->isContractorPrice;
    }

    /**
     * @param bool|null $isContractorPrice
     * @return self
     */
    public function setIsContractorPrice(?bool $isContractorPrice): self
    {
        $this->isContractorPrice = $isContractorPrice;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getVat(): ?float
    {
        return $this->vat;
    }

    /**
     * @param float|null $vat
     * @return self
     */
    public function setVat(?float $vat): self
    {
        $this->vat = $vat;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getPositionsPriceType(): ?string
    {
        return $this->positionsPriceType;
    }

    /**
     * @param string|null $positionsPriceType
     * @return self
     */
    public function setPositionsPriceType(?string $positionsPriceType): self
    {
        $this->positionsPriceType = $positionsPriceType;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getCurrencyCode(): ?string
    {
        return $this->currencyCode;
    }

    /**
     * @param string|null $currencyCode
     * @return self
     */
    public function setCurrencyCode(?string $currencyCode): self
    {
        $this->currencyCode = $currencyCode;
        return $this;
    }

}
