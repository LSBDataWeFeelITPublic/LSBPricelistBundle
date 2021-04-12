<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\DependencyInjection;


use LSB\PricelistBundle\LSBPricelistBundle;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use LSB\UtilityBundle\DependencyInjection\BaseExtension as BE;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    const CONFIG_KEY = 'lsb_pricelist';

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder(self::CONFIG_KEY);

        return $treeBuilder;
    }
}
