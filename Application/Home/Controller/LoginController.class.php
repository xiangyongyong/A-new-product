<?php
namespace Home\Controller;
use Think\Controller;
class LoginController extends BaseController {
    
	public function login() {
		layout(false);
		$this->display();
	}
	
	public function doLogin() {
		$admin = D('Users');
        $user_name = I('post.username');
        $password = I('post.password');
        if($admin->create($_POST, 4)) {
            if($admin->validPassName($user_name,$password) === TRUE) {
                $this->_ajaxSuccess('登录成功',array('url' => '/Index/index'));
            }
            else{
                $this->_ajaxFailure('密码不正确');
            }
        }
        else{
            $this->_ajaxFailure('用户名或密码格式不正确');
        }
	}
	
	public function logOut() {
		session(null);
		$this->_ajaxSuccess('退出登录！');
	}
	
}