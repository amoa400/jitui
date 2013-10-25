<?php

class CompanyAction extends Action {

	// 新建
	public function create() {
		$this->assign('pageTitle', '新建公司');
		$this->assign('typeList', $typeList);
		$this->assign('provinceList', $provinceList);
		$this->assign('cityList', $cityList);
		$this->display();
	}
	
	// 新建处理
	public function createDo() {
		// 检查头像是否正确
		import('ORG.Net.UploadFile');
		$upload = new UploadFile();
		$upload->maxSize  = 1024 * 1024;
		$upload->allowExts  = array('jpg', 'jpeg', 'png');
		$upload->savePath =  './upload/company/';
		if(!$upload->upload()) {
			$this->ajaxReturn(array('status' => 'error', 'error' => array('photo' => $upload->getErrorMsg())));
		}
		$info = $upload->getUploadFileInfo();
		$info = $info[0];
		// 写入数据库
		$para['action'] = 'company';
		$res = A('Common')->createDo($_POST, $para);
		if ($res['status'] == 'fail') {
			// 删除图片
			unlink($info['savepath'] . $info['savename']);
		} else {
			// 重命名图片
			// TODO 将图片统一转为jpg格式
			rename($info['savepath'] . $info['savename'], $info['savepath'] . $res['id'] . '.jpg');
		}
		$this->ajaxReturn($res);
	}
	
	
	// 显示
	public function show() {
		$company = D('Common', 'company')->r($_GET['id']);
		$company = $this->format($company);
		$this->assign('pageTitle', $company['name']);
		$this->assign('company', $company);
		$this->display();
	}
	
	// 获取编号名称对应表
	public function getIdNameList() {
		$const['action'] = 'company';
		$const['order'] = 'DESC';
		A('Common')->getIdNameList($const);
	}

	// 格式化
	public function format($company) {
		$company['des'] = nl2br($company['des']);
		return $company;
	}
}