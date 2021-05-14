<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Factory;

use LSB\PricelistBundle\Entity\PricelistProductListInterface;
use LSB\UtilityBundle\Factory\BaseFactory;

/**
 * Class PricelistProductListFactory
 * @package LSB\PricelistBundle\Factory
 */
class PricelistProductListFactory extends BaseFactory implements PricelistProductListFactoryInterface
{

    /**
     * @return PricelistProductListInterface
     */
    public function createNew(): PricelistProductListInterface
    {
        return parent::createNew();
    }

}
