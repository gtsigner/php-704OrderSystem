<?php
/**
 * Created by PhpStorm.
 * User: zhaojunlike
 * Date: 2016/11/18
 * Time: 9:27
 */

namespace Api\Controller;


use Think\Controller;

class ProtalController extends Controller
{
    /*
     * 登陆
     */
    public function getToken($username, $password)
    {
        $map['username'] = $username;
        $map['password'] = $password;
        $waiter = M('waiter')->where($map)->find();
        if (!$waiter) {
            $json['msg'] = "服务员户名或者密码错误";
            $json['data'] = null;
            $json['code'] = 201;
            $this->ajaxReturn($json);
        } else {
            //生成一个Token，存储
            $data['token'] = md5($waiter['id'] . $waiter['username'] . createRandOrderNo() . time());
            M('waiter')->where(array('id' => $waiter['id']))->setField('token', $data['token']);
            //TODO 登陆日志
            $json['msg'] = "登陆校验成功";
            $json['data'] = $data;
            $json['code'] = 200;
            $this->ajaxReturn($json);
        }
    }

}