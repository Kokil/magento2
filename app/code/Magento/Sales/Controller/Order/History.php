<?php
/**
 *
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */
namespace Magento\Sales\Controller\Order;

use Magento\Sales\Controller\OrderInterface;

class History extends \Magento\Framework\App\Action\Action implements OrderInterface
{
    /**
     * Customer order history
     *
     * @return void
     */
    public function execute()
    {
        $this->_view->loadLayout();
        $this->_view->getLayout()->initMessages();

        $this->_view->getPage()->getConfig()->getTitle()->set(__('My Orders'));

        $block = $this->_view->getLayout()->getBlock('customer.account.link.back');
        if ($block) {
            $block->setRefererUrl($this->_redirect->getRefererUrl());
        }
        $this->_view->renderLayout();
    }
}
