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

    public function pricelistProcedureProduct(int $productID, string $dateString, string $currencyCode, ?int $contractorID): ?array;

}
