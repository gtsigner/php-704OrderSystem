<?php
namespace Admin\Controller;

use Think\Page;
use Think\Controller;

class DeskController extends AdminController
{

    public function testData()
    {
        for ($i = 1; $i < 30; $i++) {
            $arr = [];
            $arr['table_id'] = $i;
            $arr['mark'] = '5人桌';
            $arr['status'] = 1;
            M('table')->add($arr);
        }
    }

    public function add()
    {
        if (IS_POST) {
            $user = M('table')->create();
            if (!$user) {
                $this->error("添加失败");
            }
            $result = M('table')->add($user);
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
        $count = M('table')->where($map)->count();
        $pageModel = new Page($count, $this->page_limit);

        $list = M('table')->where($map)->page($p, $this->page_limit)->select();
        $this->assign("_data", $list);
        $this->assign('_page', $pageModel->show());
        $this->display();
    }

    public function del()
    {
        $adminMap['id'] = intval(I('id'));
        if ($adminMap['id'] < 1) {
            $this->error("请正确选择要删除的桌子");
        }
        $delRet = M('table')->where($adminMap)->delete();
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
            $newData = M('table')->create();
            $result = M('table')->where(array('id' => $adminMap['id']))->save($newData); // 根据条件更新记录
            if ($result === false) {
                $this->success("修改失败");
            } else {
                $this->error("修改成功");
            }
        } else {
            $adminMap['id'] = I('id');
            $waiter = M('table')->where($adminMap)->find();
            if (!$waiter) {
                $this->error("不存在此座位号");
            }
            $this->assign('detail', $waiter);
            $this->display();
        }
    }
}