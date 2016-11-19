<?php
/**
 * Created by PhpStorm.
 * User: zhaojunlike
 * Date: 2016/11/18
 * Time: 8:55
 */

namespace Admin\Controller;


use Think\Controller;

class PublicController extends Controller
{
    public function index()
    {
        $this->login();
    }

    public function login()
    {
        $this->display("login");
    }

    public function checkLogin()
    {
        if (IS_POST) {
            $name = I('name');
            $password = I('password');
            $user = M("admin")->where(array('name' => $name))->find();
            if (!$user) {
                $this->error("管理员名不存在");
            }
            if ($user['password'] != $password) {
                $this->error("密码错误");
            }
            session('admin_user_id', $user['id']);
            redirect(U("Frame/index"));
        } else {
            $this->display();
        }
    }

    public function logout()
    {
        unset($_SESSION['admin_user_id']);
        redirect(U("login"));
    }
}