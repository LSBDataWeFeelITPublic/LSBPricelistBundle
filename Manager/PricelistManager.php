<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Manager;

use LSB\PricelistBundle\Entity\PricelistInterface;
use LSB\PricelistBundle\Factory\PricelistFactoryInterface;
use LSB\PricelistBundle\Repository\PricelistRepositoryInterface;
use LSB\UtilityBundle\Factory\FactoryInterface;
use LSB\UtilityBundle\Form\BaseEntityType;
use LSB\UtilityBundle\Manager\ObjectManagerInterface;
use LSB\UtilityBundle\Manager\BaseManager;
use LSB\UtilityBundle\Repository\RepositoryInterface;

/**
* Class PricelistManager
* @package LSB\PricelistBundle\Manager
*/
class PricelistManager extends BaseManager
{

    /**
     * PricelistManager constructor.
     * @param ObjectManagerInterface $objectManager
     * @param PricelistFactoryInterface $factory
     * @param PricelistRepositoryInterface $repository
     * @param BaseEntityType|null $form
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        PricelistFactoryInterface $factory,
        PricelistRepositoryInterface $repository,
        ?BaseEntityType $form
    ) {
        parent::__construct($objectManager, $factory, $repository, $form);
    }

    /**
     * @return PricelistInterface|object
     */
    public function createNew(): PricelistInterface
    {
        return parent::createNew();
    }

    /**
     * @return PricelistFactoryInterface|FactoryInterface
     */
    public function getFactory(): PricelistFactoryInterface
    {
        return parent::getFactory();
    }

    /**
     * @return PricelistRepositoryInterface|RepositoryInterface
     */
    public function getRepository(): PricelistRepositoryInterface
    {
        return parent::getRepository();
    }
}
