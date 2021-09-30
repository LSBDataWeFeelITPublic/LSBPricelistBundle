<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\DependencyInjection;

use LSB\PricelistBundle\Entity\Pricelist;
use LSB\PricelistBundle\Entity\PricelistInterface;
use LSB\PricelistBundle\Entity\PricelistPosition;
use LSB\PricelistBundle\Entity\PricelistPositionInterface;
use LSB\PricelistBundle\Entity\PricelistProductList;
use LSB\PricelistBundle\Entity\PricelistProductListInterface;
use LSB\PricelistBundle\Factory\PricelistFactory;
use LSB\PricelistBundle\Factory\PricelistPositionFactory;
use LSB\PricelistBundle\Factory\PricelistProductListFactory;
use LSB\PricelistBundle\Form\PricelistPositionType;
use LSB\PricelistBundle\Form\PricelistProductListType;
use LSB\PricelistBundle\Form\PricelistType;
use LSB\PricelistBundle\LSBPricelistBundle;
use LSB\PricelistBundle\Manager\PricelistManager;
use LSB\PricelistBundle\Manager\PricelistPositionManager;
use LSB\PricelistBundle\Manager\PricelistProductListManager;
use LSB\PricelistBundle\Repository\PricelistPositionRepository;
use LSB\PricelistBundle\Repository\PricelistProductListRepository;
use LSB\PricelistBundle\Repository\PricelistRepository;
use LSB\PricelistBundle\Service\TotalCalculatorManager;
use LSB\PricelistBundle\Service\TotalCalculatorManagerInterface;
use LSB\UtilityBundle\Config\Definition\Builder\TreeBuilder;
use LSB\UtilityBundle\Config\Definition\Service\ServicesConfiguration;
use Symfony\Component\Config\Definition\ConfigurationInterface;

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
            ->addServicesNodeConfiguration(
                (new ServicesConfiguration)
                    ->add(TotalCalculatorManagerInterface::class, TotalCalculatorManager::class)
            )
            ->arrayNode('defaults')
            ->addDefaultsIfNotSet()
            ->children()
            ->scalarNode('currencyCode')->defaultValue('PLN')->cannotBeEmpty()->end()
            ->scalarNode('positionsPriceType')->defaultValue(Pricelist::POSITIONS_PRICE_TYPE_NET)->cannotBeEmpty()->end()
            ->end()
            ->end()
            ->bundleTranslationDomainScalar(LSBPricelistBundle::class)->end()
            ->resourcesNode()
            ->children()
            //Pricelist
            ->resourceNode(
                'pricelist',
                Pricelist::class,
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
                PricelistPosition::class,
                PricelistPositionInterface::class,
                PricelistPositionFactory::class,
                PricelistPositionRepository::class,
                PricelistPositionManager::class,
                PricelistPositionType::class
            )
            ->end()

            //Pricelist Product List
            ->resourceNode(
                'pricelist_product_list',
                PricelistProductList::class,
                PricelistProductListInterface::class,
                PricelistProductListFactory::class,
                PricelistProductListRepository::class,
                PricelistProductListManager::class,
                PricelistProductListType::class
            )
            ->end()
            ->end()
            ->end()
            ->end();

        return $treeBuilder;
    }
}
