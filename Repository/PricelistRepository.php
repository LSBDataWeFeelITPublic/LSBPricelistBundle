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

}
