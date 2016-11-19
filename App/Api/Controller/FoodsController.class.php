<?php
/**
 * Created by PhpStorm.
 * User: zhaojunlike
 * Date: 2016/11/18
 * Time: 10:07
 */

namespace Api\Controller;


class FoodsController extends AuthApiController
{

    public function getMenus()
    {
        $map = array();
        $foods = M('foods')->where($map)->order('sort DESC')->select();
        $this->apiBack('获取菜单成功', array('foods' => $foods));
    }
}