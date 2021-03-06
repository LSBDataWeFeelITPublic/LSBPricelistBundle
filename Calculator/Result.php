<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Calculator;

use LSB\LocaleBundle\Entity\CurrencyInterface;
use Money\Money;

/**
 * Class Result
 * @package LSB\PricelistBundle\Calculator
 */
class Result
{
    /**
     * @var CurrencyInterface|null
     */
    protected ?CurrencyInterface $currency;

    /**
     * @var Money|null
     */
    protected ?Money $totalNet;

    /**
     * @var Money|null
     */
    protected ?Money $totalGross;

    /**
     * @var bool
     */
    protected bool $isSuccess;

    /**
     * @var mixed
     */
    protected mixed $subject;

    /**
     * @var array
     */
    protected array $calculationRes;

    /**
     * @var array
     */
    protected array $calculationProductRes;

    /**
     * @var array
     */
    protected array $calculationShippingRes;

    /**
     * @var array
     */
    protected array $calculationPaymentCostRes;

    /**
     * @var object|null
     */
    protected ?object $resultObject;

    /**
     * Result constructor.
     * @param bool $isSuccess
     * @param CurrencyInterface|null $currency
     * @param Money|null $totalNet
     * @param Money|null $totalGross
     * @param null $subject
     * @param array $calculationRes
     * @param array $calculationProductRes
     * @param array $calculationShippingRes
     * @param array $calculationPaymentCostRes
     * @param object|null $resultObject
     */
    public function __construct(
        bool $isSuccess,
        ?CurrencyInterface $currency,
        ?Money $totalNet,
        ?Money $totalGross,
        $subject = null,
        array &$calculationRes = [],
        array &$calculationProductRes = [],
        array &$calculationShippingRes = [],
        array &$calculationPaymentCostRes = [],
        ?object $resultObject = null
    ) {
        $this->isSuccess = $isSuccess;
        $this->currency = $currency;
        $this->totalNet = $totalNet;
        $this->totalGross = $totalGross;
        $this->subject = $subject;
        $this->calculationRes = $calculationRes;
        $this->calculationProductRes = $calculationProductRes;
        $this->calculationShippingRes = $calculationShippingRes;
        $this->calculationPaymentCostRes = $calculationPaymentCostRes;
        $this->resultObject = $resultObject;
    }

    /**
     * @return CurrencyInterface|null
     */
    public function getCurrency(): ?CurrencyInterface
    {
        return $this->currency;
    }

    /**
     * @param CurrencyInterface|null $currency
     * @return Result
     */
    public function setCurrency(?CurrencyInterface $currency): Result
    {
        $this->currency = $currency;
        return $this;
    }

    /**
     * @return Money|null
     */
    public function getTotalNet(): ?Money
    {
        return $this->totalNet;
    }

    /**
     * @param Money|null $totalNet
     * @return Result
     */
    public function setTotalNet(?Money $totalNet): Result
    {
        $this->totalNet = $totalNet;
        return $this;
    }

    /**
     * @return Money|null
     */
    public function getTotalGross(): ?Money
    {
        return $this->totalGross;
    }

    /**
     * @param Money|null $totalGross
     * @return Result
     */
    public function setTotalGross(?Money $totalGross): Result
    {
        $this->totalGross = $totalGross;
        return $this;
    }

    /**
     * @return bool
     */
    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }

    /**
     * @param bool $isSuccess
     * @return Result
     */
    public function setIsSuccess(bool $isSuccess): Result
    {
        $this->isSuccess = $isSuccess;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     * @return Result
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    /**
     * @return array
     */
    public function getCalculationRes(): array
    {
        return $this->calculationRes;
    }

    /**
     * @param array $calculationRes
     * @return Result
     */
    public function setCalculationRes(array $calculationRes): Result
    {
        $this->calculationRes = $calculationRes;
        return $this;
    }

    /**
     * @return array
     */
    public function getCalculationProductRes(): array
    {
        return $this->calculationProductRes;
    }

    /**
     * @param array $calculationProductRes
     * @return Result
     */
    public function setCalculationProductRes(array $calculationProductRes): Result
    {
        $this->calculationProductRes = $calculationProductRes;
        return $this;
    }

    /**
     * @return array
     */
    public function getCalculationShippingRes(): array
    {
        return $this->calculationShippingRes;
    }

    /**
     * @param array $calculationShippingRes
     * @return Result
     */
    public function setCalculationShippingRes(array $calculationShippingRes): Result
    {
        $this->calculationShippingRes = $calculationShippingRes;
        return $this;
    }

    /**
     * @return array
     */
    public function getCalculationPaymentCostRes(): array
    {
        return $this->calculationPaymentCostRes;
    }

    /**
     * @param array $calculationPaymentCostRes
     * @return Result
     */
    public function setCalculationPaymentCostRes(array $calculationPaymentCostRes): Result
    {
        $this->calculationPaymentCostRes = $calculationPaymentCostRes;
        return $this;
    }

    /**
     * @return object|null
     */
    public function getResultObject(): ?object
    {
        return $this->resultObject;
    }

    /**
     * @param object|null $resultObject
     * @return Result
     */
    public function setResultObject(?object $resultObject): Result
    {
        $this->resultObject = $resultObject;
        return $this;
    }
}
