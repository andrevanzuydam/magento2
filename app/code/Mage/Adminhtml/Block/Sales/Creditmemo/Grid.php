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
 * @package     Mage_Adminhtml
 * @copyright   Copyright (c) 2013 X.commerce, Inc. (http://www.magentocommerce.com)
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

/**
 * Adminhtml sales orders grid
 *
 * @author      Magento Core Team <core@magentocommerce.com>
 */
class Mage_Adminhtml_Block_Sales_Creditmemo_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    protected function _construct()
    {
        parent::_construct();
        $this->setId('sales_creditmemo_grid');
        $this->setDefaultSort('created_at');
        $this->setDefaultDir('DESC');
    }

    /**
     * Retrieve collection class
     *
     * @return string
     */
    protected function _getCollectionClass()
    {
        return 'Mage_Sales_Model_Resource_Order_Creditmemo_Grid_Collection';
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getResourceModel($this->_getCollectionClass());
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }


    protected function _prepareColumns()
    {
        $this->addColumn('increment_id', array(
            'header'    => Mage::helper('Mage_Sales_Helper_Data')->__('Credit Memo'),
            'index'     => 'increment_id',
            'type'      => 'text',
            'header_css_class'  => 'col-memo-number',
            'column_css_class'  => 'col-memo-number'
        ));

        $this->addColumn('created_at', array(
            'header'    => Mage::helper('Mage_Sales_Helper_Data')->__('Created'),
            'index'     => 'created_at',
            'type'      => 'datetime',
            'header_css_class'  => 'col-period',
            'column_css_class'  => 'col-period'
        ));

        $this->addColumn('order_increment_id', array(
            'header'    => Mage::helper('Mage_Sales_Helper_Data')->__('Order'),
            'index'     => 'order_increment_id',
            'type'      => 'text',
            'header_css_class'  => 'col-order-number',
            'column_css_class'  => 'col-order-number'
        ));

        $this->addColumn('order_created_at', array(
            'header'    => Mage::helper('Mage_Sales_Helper_Data')->__('Order Date'),
            'index'     => 'order_created_at',
            'type'      => 'datetime',
            'header_css_class'  => 'col-period',
            'column_css_class'  => 'col-period'
        ));

        $this->addColumn('billing_name', array(
            'header' => Mage::helper('Mage_Sales_Helper_Data')->__('Bill-to Name'),
            'index' => 'billing_name',
            'header_css_class'  => 'col-name',
            'column_css_class'  => 'col-name'
        ));

        $this->addColumn('state', array(
            'header'    => Mage::helper('Mage_Sales_Helper_Data')->__('Status'),
            'index'     => 'state',
            'type'      => 'options',
            'options'   => Mage::getModel('Mage_Sales_Model_Order_Creditmemo')->getStates(),
            'header_css_class'  => 'col-status',
            'column_css_class'  => 'col-status'
        ));

        $this->addColumn('grand_total', array(
            'header'    => Mage::helper('Mage_Customer_Helper_Data')->__('Refunded'),
            'index'     => 'grand_total',
            'type'      => 'currency',
            'currency'  => 'order_currency_code',
            'header_css_class'  => 'col-refunded',
            'column_css_class'  => 'col-refunded'
        ));

        $this->addColumn('action',
            array(
                'header'    => Mage::helper('Mage_Sales_Helper_Data')->__('Action'),
                'type'      => 'action',
                'getter'     => 'getId',
                'actions'   => array(
                    array(
                        'caption' => Mage::helper('Mage_Sales_Helper_Data')->__('View'),
                        'url'     => array('base'=>'*/sales_creditmemo/view'),
                        'field'   => 'creditmemo_id'
                    )
                ),
                'filter'    => false,
                'sortable'  => false,
                'is_system' => true,
                'header_css_class'  => 'col-actions',
                'column_css_class'  => 'col-actions'
        ));

        $this->addExportType('*/*/exportCsv', Mage::helper('Mage_Sales_Helper_Data')->__('CSV'));
        $this->addExportType('*/*/exportExcel', Mage::helper('Mage_Sales_Helper_Data')->__('Excel XML'));

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('creditmemo_ids');
        $this->getMassactionBlock()->setUseSelectAll(false);

        $this->getMassactionBlock()->addItem('pdfcreditmemos_order', array(
             'label'=> Mage::helper('Mage_Sales_Helper_Data')->__('PDF Credit Memos'),
             'url'  => $this->getUrl('*/sales_creditmemo/pdfcreditmemos'),
        ));

        return $this;
    }

    public function getRowUrl($row)
    {
        if (!$this->_authorization->isAllowed(null)) {
            return false;
        }

        return $this->getUrl('*/sales_creditmemo/view',
            array(
                'creditmemo_id'=> $row->getId(),
            )
        );
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/*', array('_current' => true));
    }



}
