<?php

namespace EpamTst\ModuleCustomize\Ui\Component\Listing\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use Magento\Customer\Model\ResourceModel\AddressRepository;

class Customaddr extends Column
{
    /**
     * @var addressRepository
     */
    private $addressRepository;

    /**
     * Constructor
     *
     * @param AddressRepository $AddressRepository
     * @param ContextInterface $context
     * @param UiComponentFactory $uiComponentFactory
     * @param array $components
     * @param array $data
     */
    public function __construct(
        AddressRepository $AddressRepository,
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        array $components = [],
        array $data = []
    )
    {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->addressRepository = $AddressRepository;
    }

    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
    {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $customerObj = $objectManager->create('Magento\Customer\Model\Customer');
        if (isset($dataSource['data']['items'])) {
            foreach ($dataSource['data']['items'] as & $item) {
                $customerObj->load($item['entity_id']);
                $billingID =  $customerObj->getDefaultBilling();
                $address = $objectManager->create('Magento\Customer\Model\Address')->load($billingID);
                $defaultAddress = $address->getData();
                if (isset($defaultAddress['customaddr'])) $item[$this->getData('name')] = $defaultAddress['customaddr'];
            }
        }
        return $dataSource;
    }
}