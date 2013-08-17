<?php
/**
 * Mage_Webhook_Block_Adminhtml_Subscription_Grid_Renderer_Action
 *
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade Magento to newer
 * versions in the future. If you wish to customize Magento for your
 * needs please refer to http://www.magentocommerce.com for more information.
 *
 * @category    Mage
 * @package     Mage_Webhook
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Mage_Webhook_Block_Adminhtml_Subscription_Grid_Renderer_ActionTest extends PHPUnit_Framework_TestCase
{
    public function testRenderWrongType()
    {
        $context = $this->getMockBuilder('Mage_Backend_Block_Context')
            ->disableOriginalConstructor()
            ->getMock();
        $gridRenderer = new Mage_Webhook_Block_Adminhtml_Subscription_Grid_Renderer_Action($context);
        $row = $this->getMockBuilder('Varien_Object')
            ->disableOriginalConstructor()
            ->getMock();

        $renderedRow = $gridRenderer->render($row);

        $this->assertEquals('', $renderedRow);
    }

    /**
     * @dataProvider renderDataProvider
     * @param int $status
     * @param string $contains
     */
    public function testRender($status, $contains)
    {
        $urlBuilder = $this->getMock('Mage_Core_Model_Url', array('getUrl'), array(), '', false);
        $urlBuilder->expects($this->any())
            ->method('getUrl')
            ->will($this->returnArgument(0));
        $translator = $this->getMock('Mage_Core_Model_Translate', array('translate'), array(), '', false);
        $context = $this->getMockBuilder('Mage_Backend_Block_Context')
            ->disableOriginalConstructor()
            ->getMock();
        $context->expects($this->once())
            ->method('getUrlBuilder')
            ->will($this->returnValue($urlBuilder));
        $context->expects($this->any())
            ->method('getTranslator')
            ->will($this->returnValue($translator));
        $gridRenderer = new Mage_Webhook_Block_Adminhtml_Subscription_Grid_Renderer_Action($context);
        $row = $this->getMockBuilder('Mage_Webhook_Model_Subscription')
            ->disableOriginalConstructor()
            ->getMock();
        $row->expects($this->any())
            ->method('getStatus')
            ->will($this->returnValue($status));
        $row->expects($this->any())
            ->method('getId')
            ->will($this->returnValue(42));

        $renderedRow = $gridRenderer->render($row);

        $this->assertFalse(false === strpos($renderedRow, '<a href="'), $renderedRow);
        $this->assertFalse(false === strpos($renderedRow, $contains), $renderedRow);
        $this->assertFalse(false === strpos($renderedRow, '</a>'), $renderedRow);
    }

    /**
     * Data provider for our testRender()
     *
     * @return array
     */
    public function renderDataProvider()
    {
        return array(
            array(Mage_Webhook_Model_Subscription::STATUS_ACTIVE, 'revoke'),
            array(Mage_Webhook_Model_Subscription::STATUS_REVOKED, 'activate'),
            array(Mage_Webhook_Model_Subscription::STATUS_INACTIVE, 'activate'),
        );
    }
}
