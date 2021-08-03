<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Repository;

use Doctrine\Persistence\ManagerRegistry;
use LSB\PricelistBundle\Entity\PricelistPosition;
use LSB\UtilityBundle\Repository\BaseRepository;
use LSB\UtilityBundle\Repository\PaginationRepositoryTrait;

/**
 * Class PricelistPositionRepository
 * @package LSB\PricelistBundle\Repository
 */
class PricelistPositionRepository extends BaseRepository implements PricelistPositionRepositoryInterface
{
    use PaginationRepositoryTrait;

    public function __construct(ManagerRegistry $registry, ?string $stringClass = null)
    {
        parent::__construct($registry, $stringClass ?? PricelistPosition::class);
    }

}
