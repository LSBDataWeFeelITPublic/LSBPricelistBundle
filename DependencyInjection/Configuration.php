<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\DependencyInjection;

use LSB\PricelistBundle\Entity\PricelistInterface;
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

        $treeBuilder
            ->getRootNode()
            ->children()
            ->arrayNode('defaults')
            ->children()
            ->scalarNode('currencyCode')->end()
            ->scalarNode('positionsPriceType')->end()
            ->end()
            ->end()
            ->scalarNode(BE::CONFIG_KEY_TRANSLATION_DOMAIN)->defaultValue((new \ReflectionClass(LSBPricelistBundle::class))->getShortName())->end()
            ->arrayNode(BE::CONFIG_KEY_RESOURCES)
            ->children()

            // Start Pricelist
            ->arrayNode('pricelist')
            ->addDefaultsIfNotSet()
            ->children()
            ->arrayNode(BE::CONFIG_KEY_CLASSES)
            ->children()
            ->scalarNode(BE::CONFIG_KEY_ENTITY)->end()
            ->scalarNode(BE::CONFIG_KEY_INTERFACE)->defaultValue(PricelistInterface::class)->end()
            ->scalarNode(BE::CONFIG_KEY_FACTORY)->defaultValue(PricelistFactory::class)->end()
            ->scalarNode(BE::CONFIG_KEY_REPOSITORY)->defaultValue(PricelistRepository::class)->end()
            ->scalarNode(BE::CONFIG_KEY_MANAGER)->defaultValue(PricelistManager::class)->end()
            ->scalarNode(BE::CONFIG_KEY_FORM)->defaultValue(PricelistType::class)->end()
            ->end()
            ->end()
            ->end()
            ->end()
            // End Pricelist

            // Start PricelistPosition
            ->arrayNode('pricelist_position')
            ->addDefaultsIfNotSet()
            ->children()
            ->arrayNode(BE::CONFIG_KEY_CLASSES)
            ->children()
            ->scalarNode(BE::CONFIG_KEY_ENTITY)->end()
            ->scalarNode(BE::CONFIG_KEY_INTERFACE)->defaultValue(PricelistPositionInterface::class)->end()
            ->scalarNode(BE::CONFIG_KEY_FACTORY)->defaultValue(PricelistPositionFactory::class)->end()
            ->scalarNode(BE::CONFIG_KEY_REPOSITORY)->defaultValue(PricelistPositionRepository::class)->end()
            ->scalarNode(BE::CONFIG_KEY_MANAGER)->defaultValue(PricelistPositionManager::class)->end()
            ->scalarNode(BE::CONFIG_KEY_FORM)->defaultValue(PricelistPositionType::class)->end()
            ->end()
            ->end()
            ->end()
            ->end()
            // End PricelistPosition

            ->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}
