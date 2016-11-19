<?php
/**
 * Created by PhpStorm.
 * User: zhaojunlike
 * Date: 2016/11/18
 * Time: 10:10
 */

namespace Api\Controller;


/**
 * 下单接口
 * Class OrderController
 * @package Api\Controller
 */
class OrderController extends AuthApiController
{

    public function myOrder($p = 1)
    {
        //桌子号
        $orderMap['waiter_id'] = $this->waiter['id'];
        $totalCount = M('order')->where($orderMap)->count();
        $list = M('order')->where($orderMap)->page($p, $this->page_limit)
            ->order('status ASC,create_time DESC')
            ->select();
        $data['order_list'] = $list;
        $data['p_num'] = $p;
        $data['total_count'] = $totalCount;
        $this->apiBack('获取订单列表', $data, 200);
    }



    //选座
    public function checkSeat()
    {

    }


    //下单
    public function sendOrder()
    {
        $tableMap['table_id'] = I('table_id');
        $tableEntity = M('table')->where($tableMap)->find();
        if (!$tableEntity) {
            $this->apiBack('桌位号找不到，不好意思', null, 201);
        }
        if (intval($tableEntity['status']) <= 0) {
            $this->apiBack('桌位号已经被其他用户被占了', null, 201);
        }
        $order['order_no'] = createRandOrderNo();
        $order['table_id'] = intval(I('table_id'));
        $order['waiter_id'] = $this->waiter['id'];
        $menus = htmlspecialchars_decode(I('menus'));
        $order['menus'] = $menus;
        //序列化menus，进行服务端计算价格
        $menusObj = json_decode($menus, true);
        foreach ($menusObj as $v) {
            $menuMap['id'] = $v['id'];
            $checkFoods = M('foods')->where($menuMap)->find();
            $order['money'] += ($checkFoods['price'] * $v['count']);
        }

        $order['create_time'] = time();
        $order['status'] = 0;
        $addOrderRet = M('order')->add($order);
        //更新座位状态
        $upTableRet = M('table')->where($tableEntity)->setField('status', 0);
        $retData['total_money'] = $order['money'];
        $retData['order_no'] = $order['order_no'];
        $retData['order'] = $order;
        $this->apiBack('点餐成功', $retData, 200);
    }

    //结束订单
    public function endOrder()
    {
        $orderMap['order_no'] = I('order_no');
        $orderMap['status'] = 0;//未付款
        $order = M('order')->where($orderMap)->find();
        if (!$order) {
            $this->apiBack('订单不存在，或者已经结算', null, 201);
        }
        //空置桌子
        $tableMap['table_id'] = $order['table_id'];
        $upTableRet = M('table')->where($tableMap)->setField('status', 1);
        $upOrderRet = M('order')->where($orderMap)->setField(array('end_time' => time(), 'status' => 1));
        $this->apiBack('确认收款，位置已空出', null, 200);
    }
}