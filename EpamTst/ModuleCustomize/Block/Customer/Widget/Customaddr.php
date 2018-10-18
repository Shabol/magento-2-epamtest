<?php

namespace EpamTst\ModuleCustomize\Block\Customer\Widget;

use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Customer\Api\AddressMetadataInterface;
use Magento\Customer\Api\Data\AddressInterface;
use Magento\Framework\View\Element\Template;

class Customaddr extends Template
{

    /**
     * @var AddressMetadataInterface
     */
    private $addressMetadata;

    public function __construct(
        Template\Context $context,
        AddressMetadataInterface $addressMetadata,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->addressMetadata = $addressMetadata;

    }



    protected function _construct()
    {
        parent::_construct();
        $this->setTemplate('customaddr.phtml');

    }

    /**
     * @return bool
     */
    public function isRequired()
    {
        return $this->getAttribute()
            ?   $this->getAttribute()->isRequired()
            : false;
    }



    /**
     * @return string
     */
    public function getFieldId()
    {
        return 'customaddr';
    }

    /**
     * @return \Magento\Framework\Phrase\String
     */
    public function getFieldLabel()
    {
        return $this->getAttribute()
            ?   $this->getAttribute()->getFrontendLabel()
            : __('Custom Field'); // to translate
    }

    /**
     * @return string
     */
    public function getFieldName()
    {
        return 'customaddr';
    }

    /**
     * @return string|null
     */
    public function getValue()
    {
        /** @var AddressInterface $address */
        $address = $this->getAddress();
        if ($address instanceof AddressInterface) {
            return $address->getCustomAttribute('customaddr')
                ? $address->getCustomAttribute('customaddr')->getValue()
                : null;
        }
        return null;
    }

    // public function getAttribute() { wrong public must private
    private function getAttribute()
    {
        try {
            $attribute = $this->addressMetadata->getAttributeMetadata('customaddr');
        } catch (NoSuchEntityException $exception) {
            return null;
        }
        // return $attribute[0]; // to fix by Max Pronko but error blank page if client login with empty custom
        // return $attribute; // Max Pronko but error

        // to fix by Magento Chile, customer with or not custom attribute
        if (!$attribute) {
            return $attribute[0];
        }
        else {
            // var_dump($attribute);
            return $attribute;
        }
        // end to fix by Magento Chile, customer with or not custom attribute
    }

} // end class