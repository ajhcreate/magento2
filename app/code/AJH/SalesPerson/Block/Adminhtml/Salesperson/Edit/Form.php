<?php

namespace AJH\SalesPerson\Block\Adminhtml\Salesperson\Edit;

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
        $this->_modelSalesPerson = $modelSalesPersonList;
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
        $this->setId('salesperson_form');
        $this->setTitle(__('Sales Person Information'));
    }

    /**
     * Prepare form
     *
     * @return $this
     */
    protected function _prepareForm() {
        /** @var \AJH\SalesPerson\Model\SalesPerson $model */
        $model = $this->_coreRegistry->registry('ajh_salesperson_salespersonlist');                

        /* Sales Order data */
        $salesPersonData = $this->_modelSalesPerson->create()->getCollection()->getData();                                   

        /** @var \Magento\Framework\Data\Form $form */
        $form = $this->_formFactory->create(
                ['data' => ['id' => 'edit_form', 'action' => $this->getData('action'), 'method' => 'post']]
        );

        $form->setHtmlIdPrefix('post_');

        $fieldset = $form->addFieldset(
                'base_fieldset', ['legend' => __('Sales Person'), 'class' => 'fieldset-wide']
        );

        if ($model->getId()) {
            $fieldset->addField('id', 'hidden', ['name' => 'id']);
        }
        
        $fieldset->addField(
                'sales_person', 'text', ['name' => 'sales_person', 'label' => __('Sales Person'), 'title' => __('Name'), 'required' => false]
        );

        $fieldset->addField(
                'note', 'textarea', ['name' => 'note', 'label' => __('Comment'), 'title' => __('Comment'), 'required' => false]
        );

        if ($model->getId()) {
            $data = $salesPersonData[0];
            $form->setValues($data);
        }
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}
