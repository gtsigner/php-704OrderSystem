<?php
/**
 * Created by PhpStorm.
 * User: zhaojunlike
 * Date: 2016/11/18
 * Time: 9:51
 */
/**
 * 创建随机订单
 * @return string
 */
function createRandOrderNo()
{
    $year_code = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J');
    return $year_code[intval(date('Y')) - 2010] . date("YmdHm") .
    strtoupper(dechex(date('m'))) . date('d') .
    substr(time(), -5) . substr(microtime(), 2, 5) . sprintf('d', rand(0, 99));
}