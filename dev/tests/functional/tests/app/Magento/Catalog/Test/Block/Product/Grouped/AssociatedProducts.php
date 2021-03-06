<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */

namespace Magento\Catalog\Test\Block\Product\Grouped;

use Magento\Backend\Test\Block\Widget\Tab;
use Mtf\Client\Element;
use Mtf\Client\Element\Locator;
use Mtf\Factory\Factory;

/**
 * Class AssociatedProducts
 * Associated products tab
 */
class AssociatedProducts extends Tab
{
    /**
     * 'Create New Option' button
     *
     * @var Element
     */
    protected $addNewOption = '#grouped-product-container>button';

    /**
     * Associated products grid locator
     *
     * @var string
     */
    protected $productSearchGrid = "./ancestor::body//div[div[contains(@data-role,'add-product-dialog')]]";

    /**
     * Associated products list block
     *
     * @var string
     */
    protected $associatedProductsBlock = '[data-role=grouped-product-grid]';

    /**
     * Get search grid
     *
     * @return AssociatedProducts\Search\Grid
     */
    protected function getSearchGridBlock()
    {
        return Factory::getBlockFactory()->getMagentoCatalogProductGroupedAssociatedProductsSearchGrid(
            $this->_rootElement->find($this->productSearchGrid, Locator::SELECTOR_XPATH)
        );
    }

    /**
     * Get associated products list block
     *
     * @param Element $context
     * @return \Magento\Catalog\Test\Block\Product\Grouped\AssociatedProducts\ListAssociatedProducts
     */
    protected function getListAssociatedProductsBlock(Element $context = null)
    {
        $element = $context ?: $this->_rootElement;

        return Factory::getBlockFactory()->getMagentoCatalogProductGroupedAssociatedProductsListAssociatedProducts(
            $element->find($this->associatedProductsBlock)
        );
    }

    /**
     * Fill data to fields on tab
     *
     * @param array $fields
     * @param Element|null $element
     * @return $this
     */
    public function fillFormTab(array $fields, Element $element = null)
    {
        if (isset($fields['grouped_products'])) {
            foreach ($fields['grouped_products']['value'] as $groupedProduct) {
                $element->find($this->addNewOption)->click();
                $searchBlock = $this->getSearchGridBlock();
                $searchBlock->searchAndSelect($groupedProduct['search_data']);
                $searchBlock->addProducts();
                $this->getListAssociatedProductsBlock()->fillProductOptions($groupedProduct['data']);
            }
        }

        return $this;
    }
}
