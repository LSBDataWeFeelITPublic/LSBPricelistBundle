<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Entity;

use LSB\ContractorBundle\Entity\ContractorInterface;
use LSB\LocaleBundle\Entity\CurrencyInterface;
use Doctrine\Common\Collections\Collection;

/**
 * Interface PricelistInterface
 */
interface PricelistInterface
{
    public function isEnabled(): bool;

    public function setIsEnabled(bool $isEnabled): self;

    public function getName(): ?string;

    public function setName(?string $name): self;

    public function getContractor(): ?ContractorInterface;

    public function setContractor(?ContractorInterface $contractor): self;

    public function getCurrency(): CurrencyInterface;

    public function setCurrency(CurrencyInterface $currency): self;

    public function getPositionsPriceType(): string;

    public function setPositionsPriceType(string $positionsPriceType): self;

    public function getDateFrom(): ?\DateTime;

    public function setDateFrom(?\DateTime $dateFrom): self;

    public function getDateTo(): ?\DateTime;

    public function setDateTo(?\DateTime $dateTo): self;

    public function getPricelistPositions(): Collection;

    public function setPricelistPositions(Collection $pricelistPositions): self;
}
