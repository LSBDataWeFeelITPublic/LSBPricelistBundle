<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Repository;

use Doctrine\Persistence\ManagerRegistry;
use LSB\PricelistBundle\Entity\PricelistProductList;
use LSB\UtilityBundle\Repository\BaseRepository;
use LSB\UtilityBundle\Repository\PaginationRepositoryTrait;

/**
 * Class PricelistProductListRepository
 * @package LSB\PricelistBundle\Repository
 */
class PricelistProductListRepository extends BaseRepository implements PricelistProductListRepositoryInterface
{
    use PaginationRepositoryTrait;

    /**
     * PricelistProductListRepository constructor.
     * @param ManagerRegistry $registry
     * @param string|null $stringClass
     */
    public function __construct(ManagerRegistry $registry, ?string $stringClass = null)
    {
        parent::__construct($registry, $stringClass ?? PricelistProductList::class);
    }

}
