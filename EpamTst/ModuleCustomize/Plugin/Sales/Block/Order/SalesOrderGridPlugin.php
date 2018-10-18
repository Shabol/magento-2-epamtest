<?php

namespace EpamTst\ModuleCustomize\Plugin\Sales\Block\Order;

class SalesOrderGridPlugin
{
    /**
     * @param \Magento\Sales\Block\Order\History\Interceptor $subject
     */
    public function beforeToHtml(\Magento\Sales\Block\Order\History\Interceptor $subject)
    {
        $subject->setTemplate('EpamTst_ModuleCustomize::order/history.phtml');
    }
}