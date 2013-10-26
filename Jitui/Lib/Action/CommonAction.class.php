<?php

class CommonAction extends Action {

	// 创建完成
	public function createDo($data, $para) {
		$dataClass = D('Common', $para['action']);
		$res = $dataClass->c($data);
		// 返回
		if (!empty($dataClass->errorInfo)) {
			$ret['status'] = 'fail';
			if (!empty($dataClass->errorInfo))
				$ret['error'] = $dataClass->errorInfo;
		} else {
			$ret['status'] = 'success';
			if (empty($para['jumpUrl']))
				$ret['jumpUrl'] = '/'. $para['action'] . '/show/id/' . $res;
			else
				$ret['jumpUrl'] = $para['jumpUrl'];
			$ret['id'] = $res;
		}
		if ($para['retType'] == 'ajax')
			$this->ajaxReturn($ret);
		else
			return $ret;
	}
	
	// 获取编号名称对应表
	public function getIdNameList($const) {
		$dataClass = D('Common', $const['action']);
		if (empty($const['order'])) 
			$res = $dataClass->getIdNameList();
		else
			$res = $dataClass->getIdNameList($const['order']);
		// 是否合并
		if (!empty($const['merge'])) {
			$resT = $res;
			$res = array();
			foreach($resT as $item) {
				$res[$item['id']] = $item['name'];
			}
		}
		// 返回方式
		if (!empty($const['noAjax']))
			return $res;
		else
			$this->ajaxReturn($res);
	}

	// 通过字段获取
	public function getByField($data = array()) {
		if (empty($data)) $data = $_POST;
		$res = D('Common', $data['action'])->getByField($data['name'], $data['value']);
		if ($data['retType'] == 'ajax')
			$this->ajaxReturn($res);
		else
			return $res;
	}

}