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
 * @package     Mage_DesignEditor
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Form element renderer to display composite font element for VDE
 */
class Mage_DesignEditor_Block_Adminhtml_Editor_Form_Element_Font
    extends Mage_DesignEditor_Block_Adminhtml_Editor_Form_Element_Composite_Abstract
{
    /**
     * Control type
     */
    const CONTROL_TYPE = 'font';

    /**
     * Add form elements
     *
     * @return Mage_DesignEditor_Block_Adminhtml_Editor_Form_Element_Font
     */
    protected function _addFields()
    {
        $fontData = $this->getComponent('font-picker');
        $colorData = $this->getComponent('color-picker');

        $fontHtmlId = $this->getComponentId('font-picker');
        $fontTitle = $this->_escape(sprintf("%s {%s: %s}",
            $fontData['selector'],
            $fontData['attribute'],
            $fontData['value']
        ));
        $this->addField($fontHtmlId, 'font-picker', array(
            'name'    => $fontHtmlId,
            'value'   => $fontData['value'],
            'title'   => $fontTitle,
            'options' => array_combine($fontData['options'], $fontData['options']),
            'label'   => null,
        ));

        $colorTitle = $this->_escape(sprintf("%s {%s: %s}",
            $colorData['selector'],
            $colorData['attribute'],
            $colorData['value']
        ));
        $colorHtmlId = $this->getComponentId('color-picker');
        $this->addField($colorHtmlId, 'color-picker', array(
            'name'  => $colorHtmlId,
            'value' => $colorData['value'],
            'title' => $colorTitle,
            'label' => null,
        ));

        return $this;
    }

    /**
     * Add element types used in composite font element
     *
     * @return Mage_DesignEditor_Block_Adminhtml_Editor_Form_Element_Font
     */
    protected function _addElementTypes()
    {
        $this->addType('color-picker', 'Mage_DesignEditor_Block_Adminhtml_Editor_Form_Element_ColorPicker');
        $this->addType('font-picker', 'Mage_DesignEditor_Block_Adminhtml_Editor_Form_Element_FontPicker');

        return $this;
    }
}
