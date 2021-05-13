<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Entity;

use LSB\ProductBundle\Entity\ProductInterface;
use LSB\UtilityBundle\Interfaces\IdInterface;

/**
 * Interface PricelistProductListInterface
 * @package LSB\PricelistBundle\Entity
 */
interface PricelistProductListInterface extends IdInterface
{
    public function getProduct(): ProductInterface;

    public function getPrice(): float;

    public function getDiscount(): ?float;

    public function getNetPrice(): ?float;

    public function getGrossPrice(): ?float;

    public function getBasePrice(): ?float;

    public function getBaseNetPrice(): ?float;

    public function getBaseGrossPrice(): ?float;

    public function getIsContractorPrice(): ?bool;

    public function getVat(): ?float;

    public function getPositionsPriceType(): ?string;

    public function getCurrencyCode(): ?string;
}
