<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use LSB\PricelistBundle\Entity\Pricelist;
use LSB\UtilityBundle\Repository\PaginationInterface;
use LSB\UtilityBundle\Repository\PaginationRepositoryTrait;

/**
 * Class PricelistRepository
 * @package LSB\PricelistBundle\Repository
 */
class PricelistRepository extends ServiceEntityRepository implements PricelistRepositoryInterface, PaginationInterface
{
    use PaginationRepositoryTrait;

    /**
     * PricelistRepository constructor.
     * @param ManagerRegistry $registry
     * @param string|null $stringClass
     */
    public function __construct(ManagerRegistry $registry, ?string $stringClass = null)
    {
        parent::__construct($registry, $stringClass ?? Pricelist::class);
    }

    /**
     * @param int $productID
     * @param string $dateString
     * @param string $positionsPriceType
     * @param string $currencyCode
     * @param int|null $contractorID
     * @return array|null
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Doctrine\DBAL\Exception
     */
    public function pricelistProcedureProduct(int $productID, string $dateString, string $positionsPriceType, string $currencyCode, ?int $contractorID): ?array
    {
        $sql = "SELECT * FROM pricelist_product_price($productID, '$dateString', '$positionsPriceType', '$currencyCode', " . ($contractorID ?? 'NULL') . ")";

        return $this->_em->getConnection()->executeQuery($sql)->fetchAllAssociative();
    }
}
