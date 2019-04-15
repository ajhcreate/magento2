<?php

namespace AJH\SalesPerson\Model\ResourceModel;

class SalesOrder extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb {

    protected function _construct() {
        $this->_init('sales_order_address', 'parent_id');
    }

}
