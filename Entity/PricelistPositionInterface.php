<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Entity;

use LSB\ProductBundle\Entity\ProductInterface;
use LSB\UtilityBundle\Interfaces\IdInterface;
use LSB\UtilityBundle\Interfaces\PositionInterface;
use LSB\UtilityBundle\Value\Value;
use Money\Money;

/**
 * Interface PricelistPositionInterface
 */
interface PricelistPositionInterface extends IdInterface, PositionInterface
{
    public function getPricelist(): PricelistInterface;

    public function setPricelist(PricelistInterface $pricelist): self;

    public function getProduct(): ProductInterface;

    public function setProduct(ProductInterface $product): self;

    public function getPrice(bool $useObject): Money|int|null;

    public function setPrice(Money|int|null $price): self;

    public function getDiscount(bool $useObject): Value|int|null;

    public function setDiscount(Value|int|null $discount): self;

    public function getVat(bool $useObject): Value|int|null;

    public function setVat(Value|int|null $vat): self;

    public function getUnit(): string|null;

    public function setUnit(string|null $unit): self;
}
