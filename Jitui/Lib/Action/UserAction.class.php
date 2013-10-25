<?php

class UserAction extends Action {
	// 注册
    public function register() {
		$this->assign('pageTitle', '注册');
		$this->display();
	}
	
	// 注册处理
	public function registerDo() {
		$para['action'] = 'user';
		$para['jumpUrl'] = '/';
		$res = A('Common')->createDo($_POST, $para);
		if ($res['status'] == 'success') 
			$this->loginSucceed($res['id']);
		$this->ajaxReturn($res);
	}
	
	// 登录
    public function login() {
		$this->assign('pageTitle', '登录');
		$this->display();
	}
	
	// 登录处理
    public function loginDo() {
		$user = D('Common', 'user')->getByField('email', $_POST['email']);
		if (encrypt($_POST['password']) == $user['password']) {
			$this->loginSucceed($user['user_id']);
			$ret['status'] = 'success';
			$ret['jumpUrl'] = '/';
		} else {
			$ret['status'] = 'fail';
		}
		$this->ajaxReturn($ret);
	}
	
	// 登录成功
    public function loginSucceed($user_id) {
		$user = D('Common', 'user')->r($user_id);
		$_SESSION = array();
		$_SESSION['login'] = 1;
		$_SESSION['user_id'] = $user['user_id'];
		$_SESSION['name'] = $user['name'];
	}

	// 登出
	public function logout() {
		$_SESSION = array();
		$this->redirect('/');
	}
	
	// 格式化
	public function format($user) {
		return $user;
	}
}