<?php

namespace AJH\SalesPerson\Model\ResourceModel\SalesPersonList;

use Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection;

class Collection extends AbstractCollection {    

    public function __construct(
    \Magento\Framework\Data\Collection\EntityFactoryInterface $entityFactory,
    \Psr\Log\LoggerInterface $logger,
    \Magento\Framework\Data\Collection\Db\FetchStrategyInterface $fetchStrategy,
    \Magento\Framework\Event\ManagerInterface $eventManager,
    \Magento\Store\Model\StoreManagerInterface $storeManager,
    \Magento\Framework\DB\Adapter\AdapterInterface $connection = null,
    \Magento\Framework\Model\ResourceModel\Db\AbstractDb $resource = null
    ) {
        $this->_init(
                'AJH\SalesPerson\Model\SalesPersonList', 'AJH\SalesPerson\Model\ResourceModel\SalesPersonList'
        );
        parent::__construct(
                $entityFactory, $logger, $fetchStrategy, $eventManager, $connection, $resource
        );
        $this->storeManager = $storeManager;
    }

    protected function _initSelect() {
        parent::_initSelect();                

        $objectManager = \Magento\Framework\App\ObjectManager::getInstance();
        $model = $objectManager->create('\AJH\SalesPerson\Model\SalesOrder');
        $params = $model->getPosts();                
        
        $id = isset($params['id']) && $params['id']?$params['id']:0;                

//        $this->getSelect()->joinLeft(
//                ['secondTable' => $this->getTable('ajh_salesperson_orders')], 'main_table.parent_id = secondTable.sales_order_id', ['secondTable.id as sales_person_order_id', 'secondTable.sales_order_id as orderId', 'secondTable.note as note', 'main_table.parent_id as sales_order_id']
//        );
//        $this->getSelect()->joinLeft(
//                ['thirdTable' => $this->getTable('ajh_salesperson')], 'secondTable.salesperson_id = thirdTable.id', ['thirdTable.sales_person as salesperson']
//        );
//        $this->getSelect()->joinLeft(
//                ['fourthTable' => $this->getTable('sales_order')], 'main_table.parent_id = fourthTable.entity_id', ['fourthTable.created_at as date']
//        )->group('parent_id');                        
        
        if($id){
            $this->getSelect()->where("main_table.id = '{$id}'");
        }
    }

}
