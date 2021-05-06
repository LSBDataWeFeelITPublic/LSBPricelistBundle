<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\DependencyInjection;

use LSB\PricelistBundle\Entity\Pricelist;
use LSB\PricelistBundle\Entity\PricelistInterface;
use LSB\PricelistBundle\Entity\PricelistPosition;
use LSB\PricelistBundle\Entity\PricelistPositionInterface;
use LSB\PricelistBundle\Factory\PricelistFactory;
use LSB\PricelistBundle\Factory\PricelistPositionFactory;
use LSB\PricelistBundle\Form\PricelistPositionType;
use LSB\PricelistBundle\Form\PricelistType;
use LSB\PricelistBundle\LSBPricelistBundle;
use LSB\PricelistBundle\Manager\PricelistManager;
use LSB\PricelistBundle\Manager\PricelistPositionManager;
use LSB\PricelistBundle\Repository\PricelistPositionRepository;
use LSB\PricelistBundle\Repository\PricelistRepository;
use LSB\UtilityBundle\Config\Definition\Builder\TreeBuilder;
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

        $treeBuilder
            ->getRootNode()
            ->children()
            ->arrayNode('defaults')
            ->children()
            ->scalarNode('currencyCode')->end()
            ->scalarNode('positionsPriceType')->end()
            ->end()
            ->end()
            ->bundleTranslationDomainScalar(LSBPriceListBundle::class)->end()
            ->resourcesNode()
            ->children()

            //Pricelist
            ->resourceNode(
                'pricelist',
                PriceList::class,
                PricelistInterface::class,
                PricelistFactory::class,
                PricelistRepository::class,
                PricelistManager::class,
                PricelistType::class
            )
            ->end()

            //Pricelist position
            ->resourceNode(
                'pricelist_position',
                PriceListPosition::class,
                PricelistPositionInterface::class,
                PricelistPositionFactory::class,
                PricelistPositionRepository::class,
                PricelistPositionManager::class,
                PricelistPositionType::class
            )
            ->end()

            ->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}
