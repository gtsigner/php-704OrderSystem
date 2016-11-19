<?php
/**
 * Created by PhpStorm.
 * User: zhaojunlike
 * Date: 2016/11/18
 * Time: 9:56
 */

namespace Api\Controller;


class AuthApiController extends ApiController
{
    protected $waiter;
    protected $page_limit = 20;

    protected function _initialize()
    {
        $this->_checkToken();
    }

    private function _checkToken()
    {
        $token = I('token');
        if (!$token) {
            $this->apiBack("登陆未授权", null, 201);
        }
        $tokenMap['token'] = $token;
        $waiter = M('waiter')->where($tokenMap)->find();
        if (!$waiter) {
            $this->apiBack("登陆失效", null, 201);
        }
        $this->waiter = $waiter;


    }
}