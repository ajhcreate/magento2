<?php

namespace AJH\SalesPerson\Model;

use Magento\Framework\Model\AbstractModel;

class SalesPersonList extends AbstractModel {

    protected function _construct() {
        $this->_init('AJH\SalesPerson\Model\ResourceModel\SalesPersonList');
    }

}
