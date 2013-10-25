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
		$this->assign('typeId', 1);
		$this->display();
	}
	
	// 创建平台推
    public function create2() {
		$typeList = D('Common', 'job_type')->getIdNameList('ASC');
		$provinceList = D('Common', 'province')->getIdNameList('ASC');
		$cityList = D('Common', 'city')->getAll('ASC');

		$this->assign('pageTitle', '发布平台推');
		$this->assign('typeList', $typeList);
		$this->assign('provinceList', $provinceList);
		$this->assign('cityList', $cityList);
		$this->assign('typeId', 2);
		$this->display('create');
	}
	
	// 创建处理
    public function createDo() {
		$para['action'] = 'job';
		$para['retType'] = 'ajax';
		$_POST['user_id'] = $_SESSION['user_id'];
		if ($_POST['type_id'] == 1) {
			$user = D('Common', 'user')->r($_SESSION['user_id']);
			$company = D('Common', 'company')->r($user['company_id']);
			$_POST['company_id'] = $company['company_id'];
			$_POST['company_name'] = $company['name'];
		}
		A('Common')->createDo($_POST, $para);
	}
	
	// 显示
	public function show() {
		$job = D('Common', 'job')->r($_GET['id']);
		$job = $this->format($job);
		$user = D('Common', 'user')->r($job['user_id']);
		$user = A('User')->format($user);
		$company = D('Common', 'company')->r($user['company_id']);
		$company = A('Company')->format($company);
		$this->assign('pageTitle', $job['name']);
		$this->assign('job', $job);
		$this->assign('user', $user);
		$this->assign('company', $company);
		$this->display();
	}

	// 格式化
	public function format($job) {
		// 工作性质
		switch ($job['nature_id']) {
			case 1:
				$job['nature_name'] = '全职';
			case 2:
				$job['nature_name'] = '兼职';
			case 3:
				$job['nature_name'] = '实习';
		}
		$job['des'] = nl2br($job['des']);
		$job['sub_time'] = intToTime($job['sub_time_int'], 'm-d');
		return $job;
	}
}