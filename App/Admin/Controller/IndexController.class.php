<?php
namespace Admin\Controller;

use Think\Cache\Driver\Redis;
use Think\Controller;

class IndexController extends AdminController
{


    public function index()
    {
        redirect(U('Frame/index'));
    }

    public function resetPwd()
    {
        if (IS_POST) {
            $old_pwd = I('old_pwd');
            $pwd1 = I('password');
            $pwd2 = I('password_re');
            if ($pwd1 != $pwd2) {
                $this->error("2次密码不正确");
            }
            $user = M('admin');
            $adminer = $user->where(array('id' => $this->user_id))->find();
            if ($adminer['password'] != $old_pwd) {
                $this->error("旧密码错误");
            }
            $adminer['password'] = $pwd1;
            $result = M('admin')->where(array('id' => $this->user_id))->save($adminer);
            if (false === $result) {
                echo $user->getLastSql();
                echo $user->getDbError();
            }
            $this->success("修改密码成功", U('logout'));
        } else {
            $this->display();
        }
    }
}