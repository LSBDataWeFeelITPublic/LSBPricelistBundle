<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Entity;

use LSB\UtilityBundle\Traits\CreatedUpdatedTrait;
use LSB\UtilityBundle\Traits\IdTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use LSB\ProductBundle\Entity\ProductInterface;
use LSB\UtilityBundle\Traits\PositionTrait;
use Doctrine\ORM\Mapping\MappedSuperclass;

/**
 * Class PricelistPosition
 * @package LSB\PricelistBundle\Entity
 *
 * @MappedSuperclass
 */
class PricelistPosition implements PricelistPositionInterface
{
    use IdTrait;
    use CreatedUpdatedTrait;
    use PositionTrait;

    /**
     * @ORM\ManyToOne(targetEntity="LSB\PricelistBundle\Entity\PricelistInterface", inversedBy="pricelistPositions")
     * @ORM\JoinColumn(name="pricelist_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected PricelistInterface $pricelist;

    /**
     * @ORM\ManyToOne(targetEntity="LSB\ProductBundle\Entity\ProductInterface")
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id", nullable=false, onDelete="CASCADE")
     */
    protected ProductInterface $product;

    /**
     * @ORM\Column(type="decimal", nullable=true, scale=2)
     */
    protected ?float $price;

    /**
     * @ORM\Column(type="decimal", nullable=true, scale=2)
     */
    protected ?float $discount;

    /**
     * @ORM\Column(type="decimal", nullable=true, scale=2)
     */
    protected ?float $vat;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Assert\Length(max=20)
     */
    protected ?string $unit;

    /**
     * @return PricelistInterface
     */
    public function getPricelist(): PricelistInterface
    {
        return $this->pricelist;
    }

    /**
     * @param PricelistInterface $pricelist
     * @return PricelistPosition
     */
    public function setPricelist(PricelistInterface $pricelist): PricelistPosition
    {
        $this->pricelist = $pricelist;
        return $this;
    }

    /**
     * @return ProductInterface
     */
    public function getProduct(): ProductInterface
    {
        return $this->product;
    }

    /**
     * @param ProductInterface $product
     * @return PricelistPosition
     */
    public function setProduct(ProductInterface $product): PricelistPosition
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPrice(): ?float
    {
        return $this->price;
    }

    /**
     * @param float|null $price
     * @return PricelistPosition
     */
    public function setPrice(?float $price): PricelistPosition
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
     * @return PricelistPosition
     */
    public function setDiscount(?float $discount): PricelistPosition
    {
        $this->discount = $discount;
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
     * @return PricelistPosition
     */
    public function setVat(?float $vat): PricelistPosition
    {
        $this->vat = $vat;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUnit(): ?string
    {
        return $this->unit;
    }

    /**
     * @param string|null $unit
     * @return PricelistPosition
     */
    public function setUnit(?string $unit): PricelistPosition
    {
        $this->unit = $unit;
        return $this;
    }

}
