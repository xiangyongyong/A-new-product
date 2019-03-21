<?php
namespace Home\Controller;
use Think\Controller;
class BaseController extends Controller {
	
	const OK = 1;
    const ERROR = -1;
    
	public function _initialize() {
		/**是否登陆**/
        $this->chkPri();
		$this->assign("userName",session('userInfo.user_name'));
	}
	
	public function chkPri() {
		$is_arr = array('login', 'dologin', 'logout');
        if (!session('userId')) {
            session(null);
            cookie(null);
            if (in_array(strtolower(ACTION_NAME), $is_arr)) {
                return;
            }
            //$this->redirect('/Login/login');
            echo "<script language=\"javascript\">top.location.href='/Login/login';</script>";
            die();
        }
	}
	
	protected function _ajaxExit($ret)
    {
        echo json_encode($ret, JSON_UNESCAPED_UNICODE);
        exit();
    }
	
	protected function _ajaxSuccess($msg = '操作成功', array $data = array())
    {
        $ret = array('ret' => self::OK, 'msg' => $msg, 'data' => $data);
        $this->_ajaxExit($ret);
    }

    protected function _ajaxFailure($msg = '操作失败', array $data = array())
    {
        $ret = array('ret' => self::ERROR, 'msg' => $msg, 'data' => $data);
        $this->_ajaxExit($ret);
    }
	
}