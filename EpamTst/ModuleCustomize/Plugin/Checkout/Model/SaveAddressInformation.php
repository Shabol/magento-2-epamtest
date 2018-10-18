<?php

namespace EpamTst\ModuleCustomize\Plugin\Checkout\Model;


class SaveAddressInformation
{
    protected $quoteRepository;

    public function __construct(
        \Magento\Quote\Model\QuoteRepository $quoteRepository
    )
    {
        $this->quoteRepository = $quoteRepository;
    }


    /**
     * @param \Magento\Checkout\Model\ShippingInformationManagement $subject
     * @param $cartId
     * @param \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
     */
    public function beforeSaveAddressInformation(
        \Magento\Checkout\Model\ShippingInformationManagement $subject,
        $cartId,
        \Magento\Checkout\Api\Data\ShippingInformationInterface $addressInformation
    )
    {
        $shippingAddress = $addressInformation->getShippingAddress();
        $extAttributes = $shippingAddress->getExtensionAttributes();
        $caddr = $extAttributes->getCustomaddr();
        $quote = $this->quoteRepository->getActive($cartId);
        $quote->setCustomaddr($caddr);
    }

}