<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Manager;

use LSB\PricelistBundle\Entity\PricelistProductListInterface;
use LSB\PricelistBundle\Factory\PricelistProductListFactoryInterface;
use LSB\PricelistBundle\Repository\PricelistProductListRepositoryInterface;
use LSB\UtilityBundle\Factory\FactoryInterface;
use LSB\UtilityBundle\Form\BaseEntityType;
use LSB\UtilityBundle\Manager\ObjectManagerInterface;
use LSB\UtilityBundle\Manager\BaseManager;
use LSB\UtilityBundle\Repository\RepositoryInterface;

/**
* Class PricelistProductListManager
* @package LSB\PricelistBundle\Manager
*/
class PricelistProductListManager extends BaseManager
{

    /**
     * PricelistProductListManager constructor.
     * @param ObjectManagerInterface $objectManager
     * @param PricelistProductListFactoryInterface $factory
     * @param PricelistProductListRepositoryInterface $repository
     * @param BaseEntityType|null $form
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        PricelistProductListFactoryInterface $factory,
        PricelistProductListRepositoryInterface $repository,
        ?BaseEntityType $form
    ) {
        parent::__construct($objectManager, $factory, $repository, $form);
    }

    /**
     * @return PricelistProductListInterface|object
     */
    public function createNew(): PricelistProductListInterface
    {
        return parent::createNew();
    }

    /**
     * @return PricelistProductListFactoryInterface|FactoryInterface
     */
    public function getFactory(): PricelistProductListFactoryInterface
    {
        return parent::getFactory();
    }

    /**
     * @return PricelistProductListRepositoryInterface|RepositoryInterface
     */
    public function getRepository(): PricelistProductListRepositoryInterface
    {
        return parent::getRepository();
    }
}
