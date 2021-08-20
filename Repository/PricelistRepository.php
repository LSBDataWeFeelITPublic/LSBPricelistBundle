<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Repository;

use Doctrine\Persistence\ManagerRegistry;
use LSB\PricelistBundle\Entity\Pricelist;
use LSB\UtilityBundle\Repository\BaseRepository;
use LSB\UtilityBundle\Repository\PaginationRepositoryTrait;

/**
 * Class PricelistRepository
 * @package LSB\PricelistBundle\Repository
 */
class PricelistRepository extends BaseRepository implements PricelistRepositoryInterface
{
    use PaginationRepositoryTrait;

    public function __construct(ManagerRegistry $registry, ?string $stringClass = null)
    {
        parent::__construct($registry, $stringClass ?? Pricelist::class);
    }

    /**
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Doctrine\DBAL\Exception
     */
    public function pricelistProcedureProduct(
        int    $productID,
        string $dateString,
        string $positionsPriceType,
        string $currencyCode,
        ?int   $contractorID,
        ?int   $precision
    ): ?array {
        $sql = "SELECT * FROM pricelist_product_price($productID, '$dateString', '$positionsPriceType', '$currencyCode', " . ($contractorID ?? 'NULL') . ", " . ($precision ?? 'NULL') . ")";

        return $this->_em->getConnection()->executeQuery($sql)->fetchAllAssociative();
    }

    /**
     * @throws \Doctrine\DBAL\Exception
     */
    public function pricelistProcedureProductList(
        string $dateString,
        string $positionsPriceType,
        string $currencyCode,
        ?int   $contractorID,
        ?int   $precision
    ): void {
        $sql = "SELECT pricelist_product_list('$dateString', '$positionsPriceType', '$currencyCode', " . ($contractorID ?? 'NULL') . ", " . ($precision ?? 'NULL') . ")";
        $this->_em->getConnection()->executeQuery($sql);
    }
}
