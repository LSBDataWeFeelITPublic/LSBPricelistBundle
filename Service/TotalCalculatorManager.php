<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use LSB\LocaleBundle\Entity\CurrencyInterface;
use LSB\LocaleBundle\Manager\CurrencyManager;
use LSB\LocaleBundle\Manager\TaxManager;
use LSB\PricelistBundle\Calculator\BaseTotalCalculator;
use LSB\PricelistBundle\Calculator\Result;
use LSB\PricelistBundle\Calculator\TotalCalculatorInterface;
use LSB\PricelistBundle\Manager\PricelistManager;
use LSB\UtilityBundle\Helper\ValueHelper;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class TotalCalculatorManager
 * @package LSB\PricelistBundle\Service
 */
class TotalCalculatorManager implements TotalCalculatorManagerInterface
{

    public const TOTAL_CALCULATOR_TAG_NAME = 'calculator.total';
    protected array $totalCalculators = [];

    public function __construct(
        protected ParameterBagInterface $ps,
        protected EntityManagerInterface $em,
        protected PriceListManager $priceListManager,
        protected EventDispatcherInterface $eventDispatcher,
        protected TokenStorageInterface $tokenStorage,
        protected TaxManager $taxManager,
        protected CurrencyManager $currencyManager,
        protected CalculatorModuleInventory $calculatorModuleInventory
    ) {}

    /**
     * @throws \Exception
     * @deprecated
     */
    public function addTotalCalculator(
        TotalCalculatorInterface $totalCalculator,
        array $attrs = []
    ): void {
        return;
        $totalCalculator->setAttributes($attrs);

        if (!$totalCalculator->getName()) {
            throw new \Exception('Missing calculator name');
        }

        if (!$totalCalculator->getSupportedClass()) {
            throw new \Exception('Missing calculator');
        }

        $this->totalCalculators[$totalCalculator->getSupportedClass()][$totalCalculator->getName()] = $totalCalculator;
    }

    /**
     * @throws \Exception
     */
    protected function getDefaultCurrency(): CurrencyInterface
    {
        return $this->currencyManager->getDefaultCurrency(true);
    }

    /**
     * @throws \Exception
     */
    public function getTotalCalculator(
        $subject,
        string $name = BaseTotalCalculator::NAME
    ): ?TotalCalculatorInterface {
        if (!$subject || !is_object($subject)) {
            throw new \Exception('Total calculator subject cannot be null and must be an object.');
        }

        $class = $subject::class;

        if (!$class) {
            throw new \Exception('Subject class name cannot be determined.');
        }

        $totalCalculator = $this->calculatorModuleInventory->getModuleByName($class, $name, false);

        if ($totalCalculator instanceof TotalCalculatorInterface) {
            $totalCalculator->setTotalCalculatorManager($this);
            return $totalCalculator;
        }

        //First implemented
        /** @var string $calculatorSupportedClass */
        foreach ($this->calculatorModuleInventory->getModules() as $calculatorSupportedClass => $calculators) {
            if (is_subclass_of($class, $calculatorSupportedClass)) {

                /** @var TotalCalculatorInterface $totalCalculator*/
                foreach ($calculators as $calculatorName => $totalCalculator) {
                    if ($calculatorName === $name) {
                        $totalCalculator->setTotalCalculatorManager($this);
                        return $totalCalculator;
                    }
                }
            }
        }

        return null;
    }


    public function calculateTotal(
        $subject,
        array $options = [],
        ?string $applicationCode = null,
        ?string $calculatorName = BaseTotalCalculator::NAME,
        array &$calculationRes = []
    ): Result {
        $calculator = $this->getTotalCalculator($subject, $calculatorName);

        if (!$calculator instanceof TotalCalculatorInterface) {
            throw new \Exception('No calculator found.');
        }

        try {
            $result = $calculator->calculateTotal(
                $subject,
                $options,
                $applicationCode,
                true,
                true,
                $calculationRes
            );
        } catch (\Exception $e) {
            $result = new Result(false, $this->getDefaultCurrency(), null, null);
        }

        return $result;
    }

    /**
     * @throws \Exception
     */
    public function calculatePositions(
        $subject,
        array $options,
        ?string $applicationCode = null,
        ?string $calculatorName = BaseTotalCalculator::NAME,
        array &$calculationRes = []
    ): Result {
        $calculator = $this->getTotalCalculator($subject, $calculatorName);

        if (!$calculator instanceof TotalCalculatorInterface) {
            throw new \Exception('No calculator found.');
        }

        try {
            $result = $calculator->calculatePositions(
                $subject,
                $options,
                $applicationCode,
                true,
                $calculationRes
            );

        } catch (\Exception $e) {
            $result = new Result(false, $this->getDefaultCurrency(), null, null);
        }

        return $result;
    }
}
