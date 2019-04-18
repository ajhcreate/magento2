<?php
namespace AJH\SalesPerson\Model\Api\Data;
interface TopicInterface
{
	public function getId();
	public function setId();
	
	public function getSalesOrder();
	public function setSalesOrder();
	
	public function getSalesPerson();
	public function setSalesPerson();
}