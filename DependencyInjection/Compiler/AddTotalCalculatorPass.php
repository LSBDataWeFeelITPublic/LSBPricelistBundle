<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\DependencyInjection\Compiler;

use LSB\PricelistBundle\Service\CalculatorModuleInventory;
use LSB\PricelistBundle\Service\TotalCalculatorManager;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class AddTotalCalculatorPass
 * @package LSB\PricelistBundle\DependencyInjection\Compiler
 */
class AddTotalCalculatorPass implements CompilerPassInterface
{
    /**
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if (!$container->has(CalculatorModuleInventory::class)) {
            return;
        }

        $def = $container->findDefinition(CalculatorModuleInventory::class);
        foreach ($container->findTaggedServiceIds(TotalCalculatorManager::TOTAL_CALCULATOR_TAG_NAME) as $id => $attrs) {
            $def->addMethodCall('addModule', array(new Reference($id), $attrs));
        }
    }
}
