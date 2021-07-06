<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Service;

use Doctrine\Common\Util\ClassUtils;
use Doctrine\ORM\EntityManagerInterface;
use LSB\LocaleBundle\Entity\CurrencyInterface;
use LSB\LocaleBundle\Manager\CurrencyManager;
use LSB\LocaleBundle\Manager\TaxManager;
use LSB\PricelistBundle\Calculator\BaseTotalCalculator;
use LSB\PricelistBundle\Calculator\Result;
use LSB\PricelistBundle\Calculator\TotalCalculatorInterface;
use LSB\PricelistBundle\Manager\PricelistManager;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class TotalCalculatorManager
 * @package LSB\PricelistBundle\Service
 */
class TotalCalculatorManager
{
    /**
     * @var string
     */
    public const TOTAL_CALCULATOR_TAG_NAME = 'calculator.total';

    /**
     * @var array
     */
    protected array $totalCalculators = [];

    /**
     * @var ParameterBagInterface $params
     */
    protected ParameterBagInterface $ps;

    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $em;

    /**
     * @var PriceListManager
     */
    protected PricelistManager $priceListManager;

    /**
     * @var EventDispatcherInterface
     */
    protected EventDispatcherInterface $eventDispatcher;

    /**
     * @var TokenStorageInterface
     */
    protected TokenStorageInterface $tokenStorage;

    /**
     * @var TaxManager
     */
    protected TaxManager $taxManager;

    /**
     * @var CurrencyManager
     */
    protected CurrencyManager $currencyManager;

    public function __construct(
        ParameterBagInterface $ps,
        EntityManagerInterface $em,
        PriceListManager $priceListManager,
        EventDispatcherInterface $eventDispatcher,
        TokenStorageInterface $tokenStorage,
        TaxManager $taxManager,
        CurrencyManager $currencyManager
    ) {
        $this->ps = $ps;
        $this->em = $em;
        $this->priceListManager = $priceListManager;
        $this->eventDispatcher = $eventDispatcher;
        $this->tokenStorage = $tokenStorage;
        $this->taxManager = $taxManager;
        $this->currencyManager = $currencyManager;
    }

    /**
     * @param TotalCalculatorInterface $totalCalculator
     * @param array $attrs
     * @throws \Exception
     */
    public function addTotalCalculator(
        TotalCalculatorInterface $totalCalculator,
        array $attrs = []
    ): void {
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
     * @return CurrencyInterface
     * @throws \Exception
     */
    protected function getDefaultCurrency(): CurrencyInterface
    {
        return $this->currencyManager->getDefaultCurrency(true);
    }

    /**
     * @param $subject
     * @param string $name
     * @return TotalCalculatorInterface|null
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

        dump($class);

        if (!$class) {
            throw new \Exception('Subject class name cannot be determined.');
        }

        //Exact class match
        /** @var string $calculatorSupportedClass */
        foreach ($this->totalCalculators as $calculatorSupportedClass => $calculators) {
            if ($calculatorSupportedClass === $class) {

                /** @var TotalCalculatorInterface $totalCalculator*/
                foreach ($calculators as $calculatorName => $totalCalculator) {
                    if ($calculatorName === $name) {
                        $totalCalculator->setTotalCalculatorManager($this);
                        return $totalCalculator;
                    }
                }
            }
        }

        //First implemented
        /** @var string $calculatorSupportedClass */
        foreach ($this->totalCalculators as $calculatorSupportedClass => $calculators) {
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
            $result = new Result(false, $this->getDefaultCurrency(), 0, 0);
        }

        return $result;
    }

    /**
     * @param $subject
     * @param array $options
     * @param string|null $applicationCode
     * @param string|null $calculatorName
     * @param array $calculationRes
     * @return Result
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
            $result = new Result(false, $this->getDefaultCurrency(), 0, 0);
        }

        return $result;
    }
}
