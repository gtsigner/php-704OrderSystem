<?php
/**
 * Created by PhpStorm.
 * User: zhaojunlike
 * Date: 2016/11/18
 * Time: 9:28
 */

namespace Api\Controller;


class SeatController extends AuthApiController
{
    public function getSeats()
    {
        $map = array();
        if ('' != I('status')) {
            $map['status'] = intval(I('status'));
        }
        $seats = M('table')->where($map)->select();
        $this->apiBack('获取座位成功', $seats);
    }
}