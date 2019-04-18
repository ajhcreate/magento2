<?php

namespace AJH\SalesPerson\Block\Adminhtml\Salesorder\Edit;

use AJH\SalesPerson\Model\SalesPersonFactory;
use AJH\SalesPerson\Model\SalesPersonListFactory;
use AJH\SalesPerson\Model\SalesOrderFactory;
use Magento\Cms\Model\Wysiwyg\Config;

/**
 * Adminhtml salesperson edit form
 */
class Form extends \Magento\Backend\Block\Widget\Form\Generic {

    /**
     * @var \Magento\Store\Model\System\Store
     */
    protected $_systemStore;
    protected $_modelSection;
    protected $_wysiwygConfig;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param \Magento\Cms\Model\Wysiwyg\Config $wysiwygConfig
     * @param \Magento\Store\Model\System\Store $systemStore
     * @param array $data
     */
    protected $_countryFactory;

    public function __construct(
    \Magento\Backend\Block\Template\Context $context, \Magento\Framework\Registry $registry, \Magento\Framework\Data\FormFactory $formFactory, \Magento\Store\Model\System\Store $systemStore, SalesOrderFactory $modelSalesOrder, Config $wysiwygConfig, SalesPersonFactory $modelSalesPerson, SalesPersonListFactory $modelSalesPersonList, array $data = []) {        
        $this->_systemStore = $systemStore;
        $this->_modelSalesOrder = $modelSalesOrder;
        $this->_modelSalesPerson = $modelSalesPerson;
        $this->_modelSalesPersonList = $modelSalesPersonList;
        $this->_wysiwygConfig = $wysiwygConfig;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * Init form
     *
     * @return void
     */
    protected function _construct() {
        parent::_construct();
        $this->setId('sales_order_form');
        $this->setTitle(__('Sales Order Information'));
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm() {
        /** @var \AJH\SalesPerson\Model\SalesPerson $model */
        $model = $this->_coreRegistry->registry('ajh_salesperson_salesorder');        

        /* Sales Order data */
        $salesPersonData = $this->_modelSalesPersonList->create()->getCollection()->getData();                                
        
        $sales_persons_options = array();
        foreach ($salesPersonData as $val) {
            $sales_persons_options[$val['id']] = $val['sales_person'];
        }
        
        /* Sales Order data */
        $salesOrderData = $this->_modelSalesOrder->create()->getCollection()->getData();                                
        
        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
                ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $form->setHtmlIdPrefix('post_');

        $fieldset = $form->addFieldset(
                'base_fieldset', ['legend' => __('General Information'), 'class' => 'fieldset-wide']
        );

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }

        $fieldset->addField(
                'salesperson_id', 'select', [
            'name' => 'salesperson_id',
            'label' => __('Sales Person'),
            'title' => __('Sales Person'),
            'required' => true,
            'options' => $sales_persons_options
                ]
        );

        $fieldset->addField('orderid', 'note', array(
            'label' => __('Order ID'),
            'text' => $salesOrderData[0]['parent_id'],
        ));
        
        $fieldset->addField('firstname', 'note', array(
            'label' => __('Firstname'),
            'text' => $salesOrderData[0]['firstname'],
        ));
        
        $fieldset->addField('lastname', 'note', array(
            'label' => __('Lastname'),
            'text' => $salesOrderData[0]['lastname'],
        ));
        
        $fieldset->addField('email', 'note', array(
            'label' => __('Email'),
            'text' => $salesOrderData[0]['email'],
        ));
        
        $fieldset->addField('create_at', 'note', array(
            'label' => __('Date'),
            'text' => $salesOrderData[0]['date'],
        ));

        $fieldset->addField(
                'note', 'textarea', ['name' => 'note', 'label' => __('Note'), 'title' => __('Comment'), 'required' => false]
        );
        
        $fieldset->addField(
                'sales_order_id', 'hidden', ['name' => 'sales_order_id']
        );
        
        $fieldset->addField(
                'sales_person_order_id', 'hidden', ['name' => 'id']
        );

//        $data = $model->getData();
//        $salesOrderData[0]['sales_order_id'] = $salesOrderData[0]['parent_id'];                
        
        $data = $salesOrderData[0];

        $form->setValues($data);
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}
