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

use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class InstallData implements InstallDataInterface
{
    protected $eavSetup;

    public function __construct(EavSetup $eavSetup)
    {
        $this->eavSetup = $eavSetup;
    }
	
	public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
		$setup->startSetup();
		$this->eavSetup->addAttribute(
			'catalog_product',
			'overhead',
			[
                'type' => 'decimal',
				'backend' => \Magento\Catalog\Model\Product\Attribute\Backend\Price::class,
				'label' => 'Overhead',
				'input' => 'price',
				'class' => 'overhead_input',
				'sort_order' => 7,
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

		$this->eavSetup->addAttribute(
			'catalog_product',
			'profit_percentage',
			[
                'type' => 'decimal',
				'backend' => \Magento\Catalog\Model\Product\Attribute\Backend\Price::class,
				'label' => 'Profit Percentage',
				'input' => 'price',
				'class' => 'overhead_input',
				'sort_order' => 7,
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

		$setup->endSetup();
	}
}