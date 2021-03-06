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
use LSB\UtilityBundle\Helper\ValueHelper;
use LSB\UtilityBundle\Manager\ObjectManagerInterface;
use LSB\UtilityBundle\Manager\BaseManager;
use LSB\UtilityBundle\Repository\RepositoryInterface;
use LSB\UtilityBundle\Value\Value;

/**
 * Class PricelistManager
 * @package LSB\PricelistBundle\Manager
 */
class PricelistManager extends BaseManager
{

    public function __construct(
        ObjectManagerInterface       $objectManager,
        PricelistFactoryInterface    $factory,
        PricelistRepositoryInterface $repository,
        ?BaseEntityType              $form
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
     * @throws \Exception
     */
    public function getPriceForProduct(
        ProductInterface     $product,
        ?\DateTime           $date = null,
        ?string              $positionsPriceType = null,
        ?CurrencyInterface   $currency = null,
        ?ContractorInterface $contractor = null,
        ?Value               $quantity = null
    ): ?Price {

        $date = $date ?? new \DateTime();
        $currencyCode = $currency ? $currency->getIsoCode() : $this->getBundleConfiguration()['defaults']['currencyCode'];
        $positionsPriceType = $positionsPriceType ?? $this->getBundleConfiguration()['defaults']['positionsPriceType'];
        $quantity = is_null($quantity) ? null : (int) $quantity->getAmount();

        $priceResult = $this->getRepository()->pricelistProcedureProduct(
            $product->getId(),
            $date->format('Y-m-d'),
            $positionsPriceType,
            $currencyCode,
            $contractor?->getId(),
            ValueHelper::getCurrencyPrecision($currencyCode)
        );

        if (!empty($priceResult) && $priceResult[0]['product_id']) {
            return new Price(
                $priceResult[0]['price'],
                $priceResult[0]['net_price'],
                $priceResult[0]['gross_price'],
                $priceResult[0]['base_net_price'],
                $priceResult[0]['base_gross_price'],
                $priceResult[0]['vat'],
                $priceResult[0]['currency_code']
            );
        }

        return null;
    }

}
