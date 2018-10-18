<?php
namespace EpamTst\ModuleCustomize\Plugin\Customer;

use Magento\Framework\View\LayoutInterface;

class AddressEditPlugin
{

    /**
     * @var layoutInterface
     */
    private $layout;

    /**
     * AddressEditPlugin constructor
     * @params LayoutInterface $layout
     */
    public function __construct(
        LayoutInterface $layout
    )
    {
        $this->layout = $layout;
    }


    /*
    * @param \Magento\Customer\Block\Edit $edit
    * @param string $result
    * @param string
    */
    public function afterGetNameBlockHtml(
        \Magento\Customer\Block\Address\Edit $edit,
        $result
    ) {

        $customBlock = $this->layout->createBlock(
            'EpamTst\ModuleCustomize\Block\Customer\Address\Form\Edit\Customaddr',
            'epamtst_custom_address'
        );
        return $result . $customBlock->toHtml();
    }

}