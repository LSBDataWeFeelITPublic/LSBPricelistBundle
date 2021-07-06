<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Calculator;

use LSB\PricelistBundle\Service\TotalCalculatorManager;

/**
 * Interface TotalCalculatorInterface
 * @package LSB\PricelistBundle\Calculator
 */
interface TotalCalculatorInterface
{
    /**
     * @return string
     */
    public function getName(): string;

    /**
     * @return string
     */
    public function getSupportedClass(): string;

    /**
     * @return string
     */
    public function getSupportedPositionClass(): string;

    /**
     * @return mixed
     */
    public function getSupportedClassRepository();

    /**
     * @param array $attributes
     * @return mixed
     */
    public function setAttributes(array $attributes);

    /**
     * @return mixed
     */
    public function getSupportedPositionClassRepository();

    /**
     * @return TotalCalculatorManager
     */
    public function getTotalCalculatorManager(): TotalCalculatorManager;

    /**
     * @param TotalCalculatorManager $totalCalculatorManager
     * @return $this
     */
    public function setTotalCalculatorManager(TotalCalculatorManager $totalCalculatorManager): self;

    /**
     * @param $subject
     * @param array $options
     * @param string|null $applicationCode
     * @param bool $updateSubject
     * @param bool $updatePositions
     * @param array $calculationRes
     * @return Result
     */
    public function calculateTotal(
        $subject,
        array $options,
        ?string $applicationCode,
        bool $updateSubject = true,
        bool $updatePositions = true,
        array &$calculationRes = []
    ): Result;

    /**
     * @param $subject
     * @param array $options
     * @param string|null $applicationCode
     * @param bool $updatePositions
     * @return Result
     */
    public function calculatePositions(
        $subject,
        array $options,
        ?string $applicationCode,
        bool $updatePositions = true
    ): Result;
    
}
