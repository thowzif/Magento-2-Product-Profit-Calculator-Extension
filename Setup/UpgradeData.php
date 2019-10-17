<?php
/**
 * Informatics
 * Informatics Pricecalculator
 *
 * @category   Informatics
 * @package    Informatics_Pricecalculator
 * @copyright  Copyright © 2017-2018
 */
namespace Informatics\Pricecalculator\Setup;

use Magento\Framework\Setup\UpgradeDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class UpgradeData implements UpgradeDataInterface
{
    protected $eavSetup;

    public function __construct(EavSetup $eavSetup)
    {
        $this->eavSetup = $eavSetup;
    }
	
	public function upgrade(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
		$setup->startSetup();

		if ($context->getVersion() && version_compare($context->getVersion(), '1.1.0') < 0) {

			$this->eavSetup->addAttribute(
				'catalog_product',
				'recommended_price',
				[
	                'type' => 'decimal',
					'backend' => \Magento\Catalog\Model\Product\Attribute\Backend\Price::class,
					'label' => 'Recommended Price',
					'input' => 'price',
					'class' => 'recommended_price_input',
					'sort_order' => 9,
					'global' => \Magento\Eav\Model\Entity\Attribute\ScopedAttributeInterface::SCOPE_WEBSITE,
					'required' => false,
					'used_in_product_listing' => true,
	                'apply_to' => 'simple,virtual',
	                'group' => 'Prices',
	                'is_used_in_grid' => true,
	                'is_visible_in_grid' => false,
	                'is_filterable_in_grid' => true,
				]
			);

		}

		if ($context->getVersion() && version_compare($context->getVersion(), '1.2.0') < 0) {

			$this->eavSetup->updateAttribute(
				'catalog_product',
				'overhead',
				'class',
				'validate-number'
			);

			$this->eavSetup->updateAttribute(
				'catalog_product',
				'profit_percentage',
				'class',
				'validate-number'
			);

			$this->eavSetup->updateAttribute(
				'catalog_product',
				'recommended_price',
				'class',
				'validate-number'
			);
			
		}

		$setup->endSetup();
	}
}