<?php
/**
 * @copyright Copyright (c) 2014 X.commerce, Inc. (http://www.magentocommerce.com)
 */

namespace Magento\Framework\Controller\Result;

/**
 * Class JSONTest
 *
 * @covers Magento\Framework\Controller\Result\JSON
 */
class JSONTest extends \PHPUnit_Framework_TestCase
{
    public function testRenderResult()
    {
        $json = '{"data":"data"}';
        $translatedJson = '{"data_translated":"data_translated"}';

        /** @var \Magento\Framework\Translate\InlineInterface|\PHPUnit_Framework_MockObject_MockObject
         * $translateInline
         */
        $translateInline = $this->getMock('Magento\Framework\Translate\InlineInterface', [], [], '', false);
        $translateInline->expects($this->any())->method('processResponseBody')->with($json, true)->will(
            $this->returnValue($translatedJson)
        );

        $response = $this->getMock('Magento\Framework\App\Response\Http', ['representJson'], [], '', false);
        $response->expects($this->atLeastOnce())->method('representJson')->with($json)->will($this->returnSelf());

        /** @var \Magento\Framework\Controller\Result\JSON $resultJson */
        $resultJson = (new \Magento\TestFramework\Helper\ObjectManager($this))
            ->getObject('Magento\Framework\Controller\Result\JSON', ['translateInline' => $translateInline]);
        $resultJson->setJsonData($json);
        $this->assertSame($resultJson, $resultJson->renderResult($response));
    }
}
