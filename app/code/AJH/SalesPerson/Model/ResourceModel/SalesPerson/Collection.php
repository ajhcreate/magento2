<?php

namespace AJH\SalesPerson\Model\ResourceModel\SalesPerson;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection {

//    protected function _construct() {
//        $this->_init('AJH\SalesPerson\Model\SalesPerson', 'AJH\SalesPerson\Model\ResourceModel\SalesPerson');
//    }

    protected $_idFieldName = 'id';

    public function __construct(
    \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory, \Psr\Log\LoggerInterface $logger, \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy, \Magento\Framework\Event\ManagerInterface $eventManager, \Magento\Store\Model\StoreManagerInterface $storeManager, \Magento\Framework\DB\Adapter\AdapterInterface $connection = null, \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
    ) {
        $this->_init(
                'AJH\SalesPerson\Model\SalesPerson', 'AJH\SalesPerson\Model\ResourceModel\SalesPerson'
        );
        parent::__construct(
                $entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource
        );
        $this->storeManager = $storeManager;
    }

    protected function _initSelect() {
        parent::_initSelect();

        $this->getSelect()->joinLeft(
                ['secondTable' => $this->getTable('sales_order_address')], 'main_table.sales_order_id = secondTable.parent_id', ['secondTable.parent_id as orderId']
        );
    }

}
