<?php
namespace Admin\Controller;

use Think\Controller;

class AdminController extends Controller
{
    protected $user_id;
    protected $page_limit = 20;

    public function _initialize()
    {
        $this->checkLogin();
    }

    private function checkLogin()
    {
        $adminId = session('admin_user_id');
        if (!$adminId) {
            redirect(U("public/login"));
        }
        $this->user_id = $adminId;
    }
}