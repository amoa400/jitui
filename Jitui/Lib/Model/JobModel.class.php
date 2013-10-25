<?php

class JobModel extends Model {
	// 变量
	public $errorInfo;

	// 字段名称
	public $fieldName = array(
		'job_id' 				=> 		'编号',
		'user_id' 				=> 		'用户编号',
		'name' 					=> 		'职位名称',
		'company_id' 			=> 		'公司名称',
		'company_name' 			=> 		'公司名称',
		'job_type_id' 			=> 		'职位类型',
		'job_type_name'			=> 		'职位类型',
		'province_id' 			=> 		'省份',
		'province_name' 		=> 		'省份',
		'city_id' 				=> 		'城市',
		'city_name' 			=> 		'城市',
		'nature_id' 			=> 		'工作性质',
		'des' 					=> 		'工作描述',
	);

	// 数据正确规则
	public $dataRule = array(
		array('name', 'empty'),
		array('name', 'length', array(1, 50)),
		array('job_type_id', 'empty'),
		array('job_type_id', 'int'),
		array('province_id', 'empty'),
		array('province_id', 'int'),
		array('city_id', 'empty'),
		array('city_id', 'int'),
		array('nature_id', 'empty'),
		array('nature_id', 'int'),
		array('des', 'empty'),
		array('des', 'length', array(20, 5000)),
		array('type_id', 'empty'),
		array('type_id', 'int'),
		array('company_id', 'empty'),
		array('company_id', 'int'),
		array('company_name', 'empty'),
		array('company_name', 'length', array(1, 50)),
	);
	
	//数据填充规则
	public $fillRule = array(
		array('job_type_name', array('job_type', 'job_type_id', 'name'), 'getField'),
		array('province_name', array('province', 'province_id', 'name'), 'getField'),
		array('city_name', array('city', 'city_id', 'name'), 'getField'),
		array('sub_time_int', '', 'getTime'),
	);

}