<?php

namespace EpamTst\ModuleCustomize\Setup;

use Magento\Eav\Setup\EavSetup;
use Magento\Framework\Setup\InstallDataInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\ModuleDataSetupInterface;
use Magento\Eav\Model\Config;
use Magento\Customer\Api\AddressMetadataInterface;

class InstallData implements InstallDataInterface
{
    const CUSTOM_FIELD_NAME = 'customaddr';

    /**
     * @var EavSetup
     */
    private $eavSetup;

    /**
     * @var Config
     */
    private $eavConfig;

    /**
     * InstallData constructor.
     * @param EavSetup $eavSetup
     * @param Config $config
     */
    public function __construct(
        EavSetup $eavSetup,
        Config $config
    )
    {
        $this->eavSetup = $eavSetup;
        $this->eavConfig = $config;
    }

    public function install(ModuleDataSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $this->eavSetup->addAttribute(
            AddressMetadataInterface::ENTITY_TYPE_ADDRESS,
            self::CUSTOM_FIELD_NAME,
            [
                'label' => 'Custom Address Attr',
                'type' => 'varchar',
                'input' => 'text',
                'visible' => true,
                'required' => false,
                'system' => false,
                'user_defined' => false,
                'position' => 150,
                'sort_order' => 150,
                'is_used_in_grid' => false,
                'is_visible_in_grid' => true,
                'is_filterable_in_grid' => true,
                'is_searchable_in_grid' => true
            ]
        );

        $customAttribute = $this->eavConfig->getAttribute(
            AddressMetadataInterface::ENTITY_TYPE_ADDRESS,
            self::CUSTOM_FIELD_NAME
        );

        $customAttribute->setData(
            'used_in_forms',
            ['adminhtml_customer_address', 'customer_address_edit', 'customer_register_address', 'checkout_register', 'adminhtml_checkout']
        );

        $customAttribute->save();

        $setup->endSetup();
    }
}
