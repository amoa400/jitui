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
				$ret['jumpUrl'] = '/'. $data['action'] . '/' . $data['action'] . '_id/' . $res;
			else
				$ret['jumpUrl'] = $para['jumpUrl'];
			$ret['id'] = $res;
		}
		if ($para['retType'] == 'ajax')
			$this->ajaxReturn($ret);
		else
			return $ret;
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