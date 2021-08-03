<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Calculator;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\Persistence\ObjectRepository;
use LSB\PricelistBundle\Service\TotalCalculatorManager;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

/**
 * Class BaseTotalCalculator
 * @package LSB\PricelistBundle\Calculator
 */
abstract class BaseTotalCalculator implements TotalCalculatorInterface
{

    public const NAME = 'default';

    protected const SUPPORTED_CLASS = 'abstractClass';

    protected const SUPPORTED_POSITION_CLASS = 'abstractPositionClass';

    /**
     * @var EntityManagerInterface
     */
    protected EntityManagerInterface $em;

    /**
     * @var EventDispatcherInterface
     */
    protected EventDispatcherInterface $eventDispatcher;

    /**
     * @var TokenStorageInterface
     */
    protected TokenStorageInterface $tokenStorage;

    /**
     * @var array
     */
    protected array $calculationData;

    /**
     * @var array
     */
    protected array $attributes = [];

    /**
     * @var TotalCalculatorManager
     */
    protected TotalCalculatorManager $totalCalculatorManager;

    /**
     * BaseTotalCalculator constructor.
     * @param EntityManagerInterface $em
     * @param EventDispatcherInterface $eventDispatcher
     * @param TokenStorageInterface $tokenStorage
     */
    public function __construct(
        EntityManagerInterface $em,
        EventDispatcherInterface $eventDispatcher,
        TokenStorageInterface $tokenStorage,
    ) {
        $this->em = $em;
        $this->eventDispatcher = $eventDispatcher;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->getSupportedClass();
    }

    /**
     * @return string
     */
    public function getAdditionalName(): string
    {
        return static::NAME;
    }

    /**
     * @return string
     */
    public function getSupportedClass(): string
    {
        return static::SUPPORTED_CLASS;
    }

    /**
     * @return string
     */
    public function getSupportedPositionClass(): string
    {
        return static::SUPPORTED_POSITION_CLASS;
    }

    /**
     * @return ObjectRepository
     * @throws \Exception
     */
    public function getSupportedClassRepository()
    {
        if (!$this->getSupportedClass()) {
            throw new \Exception('Missing supported class. Please set supported class in calculator class.');
        }

        return $this->em->getRepository($this->getSupportedClass());
    }

    /**
     * @return EntityRepository
     * @throws \Exception
     */
    public function getSupportedPositionClassRepository(): EntityRepository
    {
        if (!$this->getSupportedPositionClass()) {
            throw new \Exception('Missing position class. Please set supported position class in calculator class.');
        }

        $repositoryClass = $this->em->getRepository($this->getSupportedPositionClass());

        if (!$repositoryClass instanceof TotalCalculatorRepositoryInterface) {
            throw new \Exception('Repository class does not support fetching positions');
        }

        return $repositoryClass;
    }

    /**
     * @param array $attributes
     * @return mixed|void
     */
    public function setAttributes(array $attributes)
    {
        $this->attributes = $attributes;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getSupportedClass().' '.$this->getName();
    }

    /**
     * @return TotalCalculatorManager
     */
    public function getTotalCalculatorManager(): TotalCalculatorManager
    {
        return $this->totalCalculatorManager;
    }

    /**
     * @param TotalCalculatorManager $totalCalculatorManager
     * @return BaseTotalCalculator
     */
    public function setTotalCalculatorManager(TotalCalculatorManager $totalCalculatorManager): static
    {
        $this->totalCalculatorManager = $totalCalculatorManager;
        return $this;
    }
}
