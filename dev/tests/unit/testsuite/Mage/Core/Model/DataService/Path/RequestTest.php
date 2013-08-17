<?php
/**
 * Mage_Core_Model_DataService_Path_Request
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
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Mage_Core_Model_DataService_Path_RequestTest extends PHPUnit_Framework_TestCase
{

    /**
     * Test data for params
     */
    const SOME_INTERESTING_PARAMS = 'Some interesting params.';

    public function testGetChild()
    {
        $requestMock = $this->getMockBuilder('Mage_Core_Controller_Request_Http')
            ->disableOriginalConstructor()
            ->getMock();
        $requestMock->expects($this->once())
            ->method('getParams')
            ->will($this->returnValue(self::SOME_INTERESTING_PARAMS));
        $requestVisitor = new Mage_Core_Model_DataService_Path_Request($requestMock);
        $this->assertEquals(self::SOME_INTERESTING_PARAMS, $requestVisitor->getChildNode('params'));
    }

    public function testNotFound()
    {
        $requestMock = $this->getMockBuilder('Mage_Core_Controller_Request_Http')->disableOriginalConstructor()
            ->getMock();

        $requestVisitor = new Mage_Core_Model_DataService_Path_Request($requestMock);
        $this->assertEquals(null, $requestVisitor->getChildNode('foo'));
    }
}