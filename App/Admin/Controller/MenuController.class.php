<?php
namespace Admin\Controller;
use Think\Controller;
use Think\Page;
class MenuController extends AdminController {
	public function index(){
		// $limit = getPageLimit();
		$user=M('menu');
		$count=$user->count();
		
		$pagecount = 5;
		$page = new Page($count , $pagecount);
		$page->parameter = $row; //此处的row是数组，为了传递查询条件
		$page->setConfig('first','首页');
		$page->setConfig('prev','上一页');
		$page->setConfig('next','下一页');
		$page->setConfig('last','尾页');
		$page->setConfig('theme','%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% 第 '.I('p',1).' 页/共 %TOTAL_PAGE% 页 ( '.$pagecount.' 条/页 共 %TOTAL_ROW% 条)');
		$show = $page->show();
		$adminerList = $user->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign("adminerList", $adminerList);
		$this->assign('page',$show);
		$this->display();

	}
	public function add(){
		if(IS_POST){
			$data['name']=I('name');
			$data['price']=I('price');
			$data['status']=I('status');
			$user=M('menu');
			$result=$user->add($data);
			if($result){
				$this->success("添加成功");
			}else{
				 $this->error("删除失败");
			}
		}else{
			$this->display();
		}
	}
	public function del(){
		 $adminMap['id'] = intval(I('id'));
        if ($adminMap['id'] < 1) {
            $this->error("请正确选择要删除的桌号");
        }
        $delRet = M('menu')->where("id= {$adminMap['id']}")->delete();
        if ($delRet) {
            $this->success("删除成功");
        } else {
            $this->error("删除失败");
        }
	}
}