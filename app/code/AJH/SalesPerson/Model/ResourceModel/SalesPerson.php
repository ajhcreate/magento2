<?php
namespace AJH\SalesPerson\Model\ResourceModel;
class SalesPerson extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
	protected function _construct()
	{
		$this->_init('ajh_salesperson_orders', 'id');
	}
}