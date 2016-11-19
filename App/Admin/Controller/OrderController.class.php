<?php
namespace Admin\Controller;

use Think\Controller;
use Think\Page;

class OrderController extends AdminController
{
    //服务员
    public function waiterLogs($p = 1)
    {

        $map = array();
        $totalData = M('waiter')
            ->join('LEFT JOIN tb_order ON tb_order.waiter_id=tb_waiter.id')
            ->group('tb_waiter.id')
            ->where($map)
            ->field('tb_waiter.*,sum(tb_order.money) as total_money')
            ->select();
        $this->assign("_data", $totalData);
        $this->display();
    }


    public function index($p = 1)
    {
        $map = array();
        $count = M('order')->where($map)->count();
        $pageModel = new Page($count, $this->page_limit);
        $list = M('order')
            ->join('LEFT JOIN tb_waiter ON tb_waiter.id=tb_order.waiter_id')
            ->where($map)->page($p, $this->page_limit)->select();
        $this->assign("_data", $list);
        $this->assign('_page', $pageModel->show());
        $this->display();
    }

    public function del()
    {
        $adminMap['id'] = intval(I('id'));
        if ($adminMap['id'] < 1) {
            $this->error("请正确选择要删除的菜品");
        }
        $delRet = M('foods')->where($adminMap)->delete();
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
            $newData = M('foods')->create();
            $result = M('foods')->where(array('id' => $adminMap['id']))->save($newData); // 根据条件更新记录
            if ($result === false) {
                $this->success("修改失败");
            } else {
                $this->error("修改成功");
            }
        } else {
            $adminMap['id'] = I('id');
            $waiter = M('foods')->where($adminMap)->find();
            if (!$waiter) {
                $this->error("不存在这条数据");
            }
            $this->assign('detail', $waiter);
            $this->display();
        }
    }

}