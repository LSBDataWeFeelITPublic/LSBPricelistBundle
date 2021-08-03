<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Entity;

use LSB\UtilityBundle\Helper\ValueHelper;
use LSB\UtilityBundle\Traits\CreatedUpdatedTrait;
use LSB\UtilityBundle\Traits\IdTrait;
use Doctrine\ORM\Mapping as ORM;
use LSB\UtilityBundle\Value\Value;
use Money\Money;
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
     * @ORM\Column(type="integer", nullable=true)
     */
    protected ?int $price = null;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected ?int $discount = null;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected ?int $vat = null;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     * @Assert\Length(max=20)
     */
    protected ?string $unit = null;

    /**
     * @return PricelistInterface
     */
    public function getPricelist(): PricelistInterface
    {
        return $this->pricelist;
    }

    /**
     * @param PricelistInterface $pricelist
     * @return $this
     */
    public function setPricelist(PricelistInterface $pricelist): self
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
     * @return $this
     */
    public function setProduct(ProductInterface $product): self
    {
        $this->product = $product;
        return $this;
    }

    /**
     * @param bool $useObject
     * @return Money|int|null
     */
    public function getPrice(bool $useObject = false): Money|int|null
    {
        return $useObject ? ValueHelper::intToMoney($this->price, $this->pricelist?->getCurrency()?->getIsoCode()) : $this->price;
    }

    /**
     * @param Money|int|null $price
     * @return $this
     */
    public function setPrice(Money|int|null $price): self
    {
        if ($price instanceof Money) {
            [$amount, $currency] = ValueHelper::moneyToIntCurrency($price);
            $this->price = $amount;
            return $this;
        }

        $this->price = $price;
        return $this;
    }

    /**
     * @param bool $useObject
     * @return Value|int|null
     */
    public function getDiscount(bool $useObject = false): Value|int|null
    {
        return $useObject ? ValueHelper::intToValue($this->discount, Value::UNIT_PERCENTAGE) : $this->discount;
    }

    /**
     * @param Value|int|null $discount
     * @return $this
     */
    public function setDiscount(Value|int|null $discount): self
    {
        if ($discount instanceof Value) {
            [$amount, $unit] = ValueHelper::valueToIntUnit($discount);
            $this->discount = $amount;
            return $this;
        }

        $this->discount = $discount;
        return $this;
    }

    /**
     * @param bool $useObject
     * @return Value|int|null
     */
    public function getVat(bool $useObject = false): Value|int|null
    {
        return $useObject ? ValueHelper::intToValue($this->vat, Value::UNIT_PERCENTAGE) : $this->vat;
    }

    /**
     * @param Value|int|null $vat
     * @return $this
     */
    public function setVat(Value|int|null $vat): self
    {
        if ($vat instanceof Value) {
            [$amount, $unit] = ValueHelper::valueToIntUnit($vat);
            $this->vat = $amount;
            return $this;
        }

        $this->vat = $vat;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getUnit(): string|null
    {
        return $this->unit;
    }

    /**
     * @param string|null $unit
     * @return $this
     */
    public function setUnit(string|null $unit): self
    {
        $this->unit = $unit;
        return $this;
    }
}
