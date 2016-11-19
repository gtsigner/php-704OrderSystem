<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Page;

class AdminerController extends AdminController
{
    public function add()
    {
        if (IS_POST) {
            $user = M('waiter')->create();
            if (!$user) {
                $this->error("添加失败");
            }
            $result = M('waiter')->add($user);
            if ($result) {
                $this->success("添加成功");
            } else {
                $this->error("删除失败");
            }
        } else {
            $this->display();
        }
    }

    public function index($p = 1)
    {
        $map = array();
        $count = M('waiter')->where($map)->count();
        $pageModel = new Page($count, $this->page_limit);

        $list = M('waiter')->where($map)->page($p, $this->page_limit)->select();
        $this->assign("_data", $list);
        $this->assign('_page', $pageModel->show());
        $this->display();
    }

    public function del()
    {
        $adminMap['id'] = intval(I('id'));
        if ($adminMap['id'] < 1) {
            $this->error("请正确选择要删除的服务员");
        }
        $delRet = M('waiter')->where("id= {$adminMap['id']}")->delete();
        if ($delRet) {
            $this->success("删除成功");
        } else {
            $this->error("删除失败");
        }
    }

    public function update()
    {
        if (IS_POST) {
            $adminMap['id'] = intval(I('id'));
            $newData = M('waiter')->create();
            $result = M('waiter')->where(array('id' => $adminMap['id']))->save($newData); // 根据条件更新记录
            if ($result === false) {
                $this->success("修改失败");
            } else {
                $this->error("修改成功");
            }
        } else {
            $adminMap['id'] = I('id');
            $waiter = M('waiter')->where($adminMap)->find();
            if (!$waiter) {
                $this->error("不存在此服务员");
            } else {

            }
            $this->assign('waiter', $waiter);
            $this->display();
        }
    }

}