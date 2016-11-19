<?php
namespace Admin\Controller;

use Think\Page;
use Think\Controller;
use Think\Upload;

/**
 * Class FoodsController
 * @package Admin\Controller
 */
class FoodsController extends AdminController
{
    public function add()
    {
        if (IS_POST) {
            $data = M('foods')->create();

            $upConfig = C('DOWNLOAD_UPLOAD');

            $upModel = new Upload($upConfig);
            $uploadRet = $upModel->upload($_FILES);
            if (!$uploadRet) {
                $this->error("上传文件失败");
            }
            $upImgPath = $upConfig['rootPath'] . $uploadRet['img_file']['savepath'] . $uploadRet['img_file']['savename'];
            if (!$data) {
                $this->error("添加失败");
            }
            $data['img_path'] = $upImgPath;
            $result = M('foods')->add($data);
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
        $count = M('foods')->where($map)->count();
        $pageModel = new Page($count, $this->page_limit);

        $list = M('foods')->where($map)->page($p, $this->page_limit)->select();
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