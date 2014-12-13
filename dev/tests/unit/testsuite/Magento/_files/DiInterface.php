<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */
namespace Magento\Test\Di;

interface DiInterface
{
    /**
     * @param string $param
     * @return mixed
     */
    public function wrap($param);
}
