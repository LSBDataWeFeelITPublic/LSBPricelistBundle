<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Entity;

use LSB\ProductBundle\Entity\ProductInterface;
use LSB\UtilityBundle\Interfaces\IdInterface;
use LSB\UtilityBundle\Value\Value;
use Money\Money;

/**
 * Interface PricelistProductListInterface
 * @package LSB\PricelistBundle\Entity
 */
interface PricelistProductListInterface extends IdInterface
{
    public function getProduct(): ProductInterface;

    public function getPrice(bool $useObject): Money|int;

    public function getDiscount(bool $useObject): Value|int|null;

    public function getNetPrice(bool $useObject): Money|int|null;

    public function getGrossPrice(bool $useObject): Money|int|null;

    public function getBasePrice(bool $useObject): Money|int|null;

    public function getBaseNetPrice(bool $useObject): Money|int|null;

    public function getBaseGrossPrice(bool $useObject): Money|int|null;

    public function getIsContractorPrice(): bool|null;

    public function getVat(bool $useObject): Value|int|null;

    public function getPositionsPriceType(): string|null;

    public function getCurrencyCode(): string|null;
}
