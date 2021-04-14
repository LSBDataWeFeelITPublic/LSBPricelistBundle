<?php
declare(strict_types=1);

namespace LSB\PricelistBundle\Manager;

use LSB\ContractorBundle\Entity\ContractorInterface;
use LSB\LocaleBundle\Entity\CurrencyInterface;
use LSB\PricelistBundle\Entity\PricelistInterface;
use LSB\PricelistBundle\Factory\PricelistFactoryInterface;
use LSB\PricelistBundle\Model\Price;
use LSB\PricelistBundle\Repository\PricelistRepositoryInterface;
use LSB\ProductBundle\Entity\ProductInterface;
use LSB\UtilityBundle\Factory\FactoryInterface;
use LSB\UtilityBundle\Form\BaseEntityType;
use LSB\UtilityBundle\Manager\ObjectManagerInterface;
use LSB\UtilityBundle\Manager\BaseManager;
use LSB\UtilityBundle\Repository\RepositoryInterface;

/**
 * Class PricelistManager
 * @package LSB\PricelistBundle\Manager
 */
class PricelistManager extends BaseManager
{

    /**
     * PricelistManager constructor.
     * @param ObjectManagerInterface $objectManager
     * @param PricelistFactoryInterface $factory
     * @param PricelistRepositoryInterface $repository
     * @param BaseEntityType|null $form
     */
    public function __construct(
        ObjectManagerInterface $objectManager,
        PricelistFactoryInterface $factory,
        PricelistRepositoryInterface $repository,
        ?BaseEntityType $form
    ) {
        parent::__construct($objectManager, $factory, $repository, $form);
    }

    /**
     * @return PricelistInterface|object
     */
    public function createNew(): PricelistInterface
    {
        return parent::createNew();
    }

    /**
     * @return PricelistFactoryInterface|FactoryInterface
     */
    public function getFactory(): PricelistFactoryInterface
    {
        return parent::getFactory();
    }

    /**
     * @return PricelistRepositoryInterface|RepositoryInterface
     */
    public function getRepository(): PricelistRepositoryInterface
    {
        return parent::getRepository();
    }

    /**
     * @param ProductInterface $product
     * @param \DateTime|null $date
     * @param CurrencyInterface|null $currency
     * @param ContractorInterface|null $contractor
     * @return Price|null
     */
    public function getPriceForProduct(
        ProductInterface $product,
        ?\DateTime $date = null,
        ?CurrencyInterface $currency = null,
        ?ContractorInterface $contractor = null
    ): ?Price {
        $date = $date ?? new \DateTime();
        $currencyCode = $currency ? $currency->getIsoCode() : 'PLN'; // TODO default currency z configa

        $priceResult = $this->getRepository()->pricelistProcedureProduct(
            $product->getId(),
            $date->format('Y-m-d'),
            $currencyCode,
            $contractor ? $contractor->getId() : null
        );
        
        if (!empty($priceResult) && $priceResult[0]['productid']) {
            return new Price(
                $priceResult[0]['netprice'],
                $priceResult[0]['grossprice'],
                $priceResult[0]['vat'],
                $priceResult[0]['currencycode']
            );
        }

        return null;
    }
}
