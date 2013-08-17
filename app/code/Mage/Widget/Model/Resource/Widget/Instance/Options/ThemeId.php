<?php
/**
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
 * @package     Mage_Widget
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
/**
 * Widget Instance Theme Id Options
 *
 * @category    Mage
 * @package     Mage_Widget
 * @author      Magento Core Team <core@magentocommerce.com>
 */

class Mage_Widget_Model_Resource_Widget_Instance_Options_ThemeId implements Mage_Core_Model_Option_ArrayInterface
{
    /**
     * @var Mage_Widget_Model_Widget_Instance
     */
    protected $_resourceModel;

    /**
     * @param Mage_Core_Model_Resource_Theme_Collection $widgetResourceModel
     */
    public function __construct(Mage_Core_Model_Resource_Theme_Collection $widgetResourceModel)
    {
        $this->_resourceModel = $widgetResourceModel;
    }

    public function toOptionArray()
    {
        return $this->_resourceModel->toOptionHash();
    }
}
