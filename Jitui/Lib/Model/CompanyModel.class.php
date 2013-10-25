<?php

class CompanyModel extends Model {
	// 变量
	public $errorInfo;

	// 字段名称
	public $fieldName = array(
	);
	
	// 数据正确规则
	public $dataRule = array(
		array('name', 'empty'),
		array('name', 'length', array(2, 50)),
		array('des', 'empty'),
		array('des', 'length', array(20, 5000)),

	);
	
	//数据填充规则
	public $fillRule = array(
	);

}