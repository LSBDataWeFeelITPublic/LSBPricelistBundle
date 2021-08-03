<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Entity;

use LSB\UtilityBundle\Helper\ValueHelper;
use LSB\UtilityBundle\Traits\IdTrait;
use Doctrine\ORM\Mapping as ORM;
use LSB\ProductBundle\Entity\ProductInterface;
use Doctrine\ORM\Mapping\MappedSuperclass;
use LSB\UtilityBundle\Value\Value;
use Money\Money;

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
     * @ORM\Column(type="integer", nullable=false)
     */
    protected int $price;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected ?int $discount = null;

    /**
     * @ORM\Column(type="integer", name="net_price", nullable=true)
     */
    protected ?int $netPrice = null;

    /**
     * @ORM\Column(type="integer", name="gross_price", nullable=true)
     */
    protected ?int $grossPrice = null;

    /**
     * @ORM\Column(type="integer", name="base_price", nullable=true)
     */
    protected ?int $basePrice = null;

    /**
     * @ORM\Column(type="integer", name="base_net_price", nullable=true)
     */
    protected ?int $baseNetPrice = null;

    /**
     * @ORM\Column(type="integer", name="base_gross_price", nullable=true)
     */
    protected ?int $baseGrossPrice = null;

    /**
     * @ORM\Column(type="boolean", name="is_contractor_price", nullable=true)
     */
    protected ?bool $isContractorPrice;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected ?int $vat = null;

    /**
     * @ORM\Column(type="string", name="positions_price_type", nullable=true, length="10")
     */
    protected ?string $positionsPriceType;

    /**
     * @ORM\Column(type="string", name="currency_code", nullable=true, length="20")
     */
    protected ?string $currencyCode;


    public function getProduct(): ProductInterface
    {
        return $this->product;
    }

    public function getPrice(bool $useObject = false): Money|int
    {
        return $useObject ? ValueHelper::intToMoney($this->price, $this->currencyCode) : $this->price;
    }

    public function getDiscount(bool $useObject = false): Value|int|null
    {
        return $useObject ? ValueHelper::intToValue($this->discount, Value::UNIT_PERCENTAGE) : $this->discount;
    }

    public function getNetPrice(bool $useObject = false): Money|int|null
    {
        return $useObject ? ValueHelper::intToMoney($this->netPrice, $this->currencyCode) : $this->netPrice;
    }

    public function getGrossPrice(bool $useObject = false): Money|int|null
    {
        return $useObject ? ValueHelper::intToMoney($this->grossPrice, $this->currencyCode) : $this->grossPrice;
    }

    public function getBasePrice(bool $useObject = false): Money|int|null
    {
        return $useObject ? ValueHelper::intToMoney($this->basePrice, $this->currencyCode) : $this->basePrice;
    }

    public function getBaseNetPrice(bool $useObject = false): Money|int|null
    {
        return $useObject ? ValueHelper::intToMoney($this->baseNetPrice, $this->currencyCode) : $this->baseNetPrice;
    }

    public function getBaseGrossPrice(bool $useObject = false): Money|int|null
    {
        return $useObject ? ValueHelper::intToMoney($this->baseGrossPrice, $this->currencyCode) : $this->baseGrossPrice;
    }

    public function getIsContractorPrice(): bool|null
    {
        return $this->isContractorPrice;
    }

    public function getVat(bool $useObject = false): Value|int|null
    {
        return $useObject ? ValueHelper::intToValue($this->vat, Value::UNIT_PERCENTAGE) : $this->vat;
    }

    public function getPositionsPriceType(): string|null
    {
        return $this->positionsPriceType;
    }

    public function getCurrencyCode(): string|null
    {
        return $this->currencyCode;
    }
}
