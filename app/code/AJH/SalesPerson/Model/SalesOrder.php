<?php

namespace AJH\SalesPerson\Model;

use Magento\Framework\Model\AbstractModel;

class SalesOrder extends AbstractModel {    

    protected function _construct() {
        $this->_init('AJH\SalesPerson\Model\ResourceModel\SalesOrder');
    }

    public function getPosts() {
        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $request = $objectManager->get('Magento\Framework\App\Request\Http');
        $params = $request->getParams();
        return $params;
    }

}
