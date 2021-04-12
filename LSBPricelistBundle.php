<?php

namespace LSB\PricelistBundle;

use LSB\PricelistBundle\DependencyInjection\Compiler\AddManagerResourcePass;
use LSB\PricelistBundle\DependencyInjection\Compiler\AddResolveEntitiesPass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * Class LSBPricelistBundle
 * @package LSB\PricelistBundle
 */
class LSBPricelistBundle extends Bundle
{

    /**
     * @param ContainerBuilder $builder
     */
    public function build(ContainerBuilder $builder)
    {
        parent::build($builder);

        $builder
            ->addCompilerPass(new AddManagerResourcePass())
            ->addCompilerPass(new AddResolveEntitiesPass(), PassConfig::TYPE_BEFORE_OPTIMIZATION, 1);
        ;
    }


}
