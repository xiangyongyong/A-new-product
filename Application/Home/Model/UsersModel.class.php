<?php
namespace Home\Model;
use Think\Model;

class UsersModel extends BaseModel
{

    /***  登入验证@return boolean */
	public function validPassName($user_name,$password)
	{
        $user = $this->table('n_users')->where("user_name='$user_name'")->find(); // 查数据库取出数据并覆盖模型中的数据
        if($user && $user['deleted']==0){
            // 再判断用户输入的密码是否正确
            if(password_verify($password, $user['password'])){
                session('userId', $user['id']);
                $userInfo = array();
                $userInfo['user_name']=$user['user_name'];
                $userInfo['real_name']=$user['real_name'];
                $userInfo['user_id']=$user['id'];
                $userInfo['mobile'] = $user['mobile'];
                //$userInfo['user_type'] = '10';
                session('userInfo',$userInfo);
                return TRUE;
            }
            return FALSE;
        }
        else{
            return FALSE;
        }
	}

}