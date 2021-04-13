<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Entity;

use LSB\ProductBundle\Entity\ProductInterface;

/**
 * Interface PricelistPositionInterface
 */
interface PricelistPositionInterface
{
    public function getPricelist(): PricelistInterface;

    public function setPricelist(PricelistInterface $pricelist): self;

    public function getProduct(): ProductInterface;

    public function setProduct(ProductInterface $product): self;

    public function getPrice(): ?float;

    public function setPrice(?float $price): self;

    public function getDiscount(): ?float;

    public function setDiscount(?float $discount): self;

    public function getVat(): ?float;

    public function setVat(?float $vat): self;

    public function getUnit(): ?string;

    public function setUnit(?string $unit): self;
}
