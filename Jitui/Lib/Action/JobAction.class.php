<?php

class JobAction extends Action {
	// 创建
    public function create() {
		$typeList = D('Common', 'job_type')->getIdNameList('ASC');
		$provinceList = D('Common', 'province')->getIdNameList('ASC');
		$cityList = D('Common', 'city')->getAll('ASC');
		$this->assign('pageTitle', '发布内推');
		$this->assign('typeList', $typeList);
		$this->assign('provinceList', $provinceList);
		$this->assign('cityList', $cityList);
		$this->display();
	}
	
	// 创建处理
    public function createDo() {
		$para['action'] = 'job';
		$para['retType'] = 'ajax';
		$_POST['user_id'] = $_SESSION['user_id'];
		A('Common')->createDo($_POST, $para);
	}
	
	// 显示
	public function show() {
		$job = D('Common', 'job')->r($_GET['id']);
		dump($job);
	}

}