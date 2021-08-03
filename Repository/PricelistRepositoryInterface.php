<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Repository;

use LSB\UtilityBundle\Repository\RepositoryInterface;

/**
 * Interface PricelistRepositoryInterface
 * @package LSB\PricelistBundle\Repository
 */
interface PricelistRepositoryInterface extends RepositoryInterface
{

    public function pricelistProcedureProduct(int $productID, string $dateString, string $positionsPriceType, string $currencyCode, ?int $contractorID, ?int $precision): ?array;

    public function pricelistProcedureProductList(string $dateString, string $positionsPriceType, string $currencyCode, ?int $contractorID, ?int $precision): void;

}
