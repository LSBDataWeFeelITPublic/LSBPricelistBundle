<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Entity;

use LSB\ContractorBundle\Entity\ContractorInterface;
use LSB\UtilityBundle\Traits\CreatedUpdatedTrait;
use LSB\UtilityBundle\Traits\UuidTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use LSB\LocaleBundle\Entity\CurrencyInterface;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping\MappedSuperclass;

/**
 * Class Pricelist
 * @package LSB\PricelistBundle\Entity
 *
 * @MappedSuperclass
 */
class Pricelist implements PricelistInterface
{
    use UuidTrait;
    use CreatedUpdatedTrait;

    const POSITIONS_PRICE_TYPE_NET = 'net';
    const POSITIONS_PRICE_TYPE_GROSS = 'gross';

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected bool $isEnabled;

    /**
     * @ORM\Column(type="string", length=100, nullable=true)
     * @Assert\Length(max=100)
     */
    protected ?string $name;

    /**
     * @ORM\ManyToOne(targetEntity="LSB\ContractorBundle\Entity\ContractorInterface")
     * @ORM\JoinColumn(name="contractor_id", referencedColumnName="id", nullable=true)
     */
    protected ?ContractorInterface $contractor;

    /**
     * @ORM\ManyToOne(targetEntity="LSB\LocaleBundle\Entity\CurrencyInterface")
     * @ORM\JoinColumn(name="currency_id", referencedColumnName="id", nullable=true)
     */
    protected CurrencyInterface $currency;

    /**
     * @ORM\Column(type="string", length=10, nullable=false)
     * @Assert\Length(max=10)
     */
    protected string $positionsPriceType;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected ?\DateTime $dateFrom;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected ?\DateTime $dateTo;

    /**
     * @var Collection|PricelistPositionInterface[]
     * @ORM\OneToMany(targetEntity="LSB\PricelistBundle\Entity\PricelistPositionInterface", mappedBy="pricelist")
     */
    protected Collection $pricelistPositions;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->generateUuid();
        $this->pricelistPositions = new ArrayCollection();
    }

    /**
     * @throws \Exception
     */
    public function __clone()
    {
        if ($this->getId()) {
            $this->id = null;
        }

        $this->generateUuid($force = true);
    }

    public function isEnabled(): bool
    {
        return $this->isEnabled;
    }

    public function setIsEnabled(bool $isEnabled): Pricelist
    {
        $this->isEnabled = $isEnabled;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Pricelist
    {
        $this->name = $name;
        return $this;
    }

    public function getContractor(): ?ContractorInterface
    {
        return $this->contractor;
    }

    public function setContractor(?ContractorInterface $contractor): Pricelist
    {
        $this->contractor = $contractor;
        return $this;
    }

    public function getCurrency(): CurrencyInterface
    {
        return $this->currency;
    }

    public function setCurrency(CurrencyInterface $currency): Pricelist
    {
        $this->currency = $currency;
        return $this;
    }

    public function getPositionsPriceType(): string
    {
        return $this->positionsPriceType;
    }

    public function setPositionsPriceType(string $positionsPriceType): Pricelist
    {
        $this->positionsPriceType = $positionsPriceType;
        return $this;
    }

    public function getDateFrom(): ?\DateTime
    {
        return $this->dateFrom;
    }

    public function setDateFrom(?\DateTime $dateFrom): Pricelist
    {
        $this->dateFrom = $dateFrom;
        return $this;
    }

    public function getDateTo(): ?\DateTime
    {
        return $this->dateTo;
    }

    public function setDateTo(?\DateTime $dateTo): Pricelist
    {
        $this->dateTo = $dateTo;
        return $this;
    }

    public function getPricelistPositions(): Collection
    {
        return $this->pricelistPositions;
    }

    public function setPricelistPositions(Collection $pricelistPositions): Pricelist
    {
        $this->pricelistPositions = $pricelistPositions;
        return $this;
    }

}
