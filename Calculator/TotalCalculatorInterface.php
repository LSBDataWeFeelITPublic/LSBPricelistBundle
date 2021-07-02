<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Calculator;

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
}
