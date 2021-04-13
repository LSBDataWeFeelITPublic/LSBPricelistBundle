<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Factory;

use LSB\PricelistBundle\Entity\PricelistPositionInterface;
use LSB\UtilityBundle\Factory\BaseFactory;

/**
 * Class PricelistPositionFactory
 * @package LSB\PricelistBundle\Factory
 */
class PricelistPositionFactory extends BaseFactory implements PricelistPositionFactoryInterface
{

    /**
     * @return PricelistPositionInterface
     */
    public function createNew(): PricelistPositionInterface
    {
        return parent::createNew();
    }

}
