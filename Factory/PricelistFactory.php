<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Factory;

use LSB\PricelistBundle\Entity\PricelistInterface;
use LSB\UtilityBundle\Factory\BaseFactory;

/**
 * Class PricelistFactory
 * @package LSB\PricelistBundle\Factory
 */
class PricelistFactory extends BaseFactory implements PricelistFactoryInterface
{

    /**
     * @return PricelistInterface
     */
    public function createNew(): PricelistInterface
    {
        return parent::createNew();
    }

}
