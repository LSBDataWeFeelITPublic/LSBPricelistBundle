<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Manager;

use LSB\PricelistBundle\Entity\PricelistPositionInterface;
use LSB\PricelistBundle\Factory\PricelistPositionFactoryInterface;
use LSB\PricelistBundle\Repository\PricelistPositionRepositoryInterface;
use LSB\UtilityBundle\Factory\FactoryInterface;
use LSB\UtilityBundle\Form\BaseEntityType;
use LSB\UtilityBundle\Manager\ObjectManagerInterface;
use LSB\UtilityBundle\Manager\BaseManager;
use LSB\UtilityBundle\Repository\RepositoryInterface;

/**
 * Class PricelistPositionManager
 * @package LSB\PricelistBundle\Manager
 */
class PricelistPositionManager extends BaseManager
{

    public function __construct(
        ObjectManagerInterface               $objectManager,
        PricelistPositionFactoryInterface    $factory,
        PricelistPositionRepositoryInterface $repository,
        ?BaseEntityType                      $form
    ) {
        parent::__construct($objectManager, $factory, $repository, $form);
    }

    /**
     * @return PricelistPositionInterface|object
     */
    public function createNew(): PricelistPositionInterface
    {
        return parent::createNew();
    }

    /**
     * @return PricelistPositionFactoryInterface|FactoryInterface
     */
    public function getFactory(): PricelistPositionFactoryInterface
    {
        return parent::getFactory();
    }

    /**
     * @return PricelistPositionRepositoryInterface|RepositoryInterface
     */
    public function getRepository(): PricelistPositionRepositoryInterface
    {
        return parent::getRepository();
    }
}
