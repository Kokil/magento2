<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */
namespace Magento\ProductAlert\Block\Product;

/**
 * Product view price and stock alerts
 */
class View extends \Magento\Framework\View\Element\Template
{
    /**
     * @var \Magento\Framework\Registry
     */
    protected $_registry;

    /**
     * Helper instance
     *
     * @var \Magento\ProductAlert\Helper\Data
     */
    protected $_helper;

    /**
     * @var \Magento\Core\Helper\PostData
     */
    protected $coreHelper;

    /**
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\ProductAlert\Helper\Data $helper
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Core\Helper\PostData $coreHelper
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\ProductAlert\Helper\Data $helper,
        \Magento\Framework\Registry $registry,
        \Magento\Core\Helper\PostData $coreHelper,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_registry = $registry;
        $this->_helper = $helper;
        $this->coreHelper = $coreHelper;
    }

    /**
     * Retrieve currently edited product object
     *
     * @return \Magento\Catalog\Model\Product|boolean
     */
    protected function getProduct()
    {
        $product = $this->_registry->registry('current_product');
        if ($product && $product->getId()) {
            return $product;
        }
        return false;
    }

    /**
     * Retrieve post action config
     *
     * @return string
     */
    public function getPostAction()
    {
        return $this->coreHelper->getPostData($this->getSignupUrl());
    }
}
