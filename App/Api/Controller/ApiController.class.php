<?php
/**
 * Created by PhpStorm.
 * User: zhaojunlike
 * Date: 2016/11/18
 * Time: 9:23
 */

namespace Api\Controller;


use Think\Controller;

class ApiController extends Controller
{
    public function apiBack($msg, $data = null, $code = 200)
    {
        $json['msg'] = $msg;
        $json['data'] = $data;
        $json['code'] = $code;
        $this->ajaxReturn($json);
    }
}