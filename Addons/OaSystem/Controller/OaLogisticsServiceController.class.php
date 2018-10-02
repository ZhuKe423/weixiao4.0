<?php

namespace Addons\OaSystem\Controller;
use Think\ManageBaseController;

class OaLogisticsServiceController extends ManageBaseController
{
    var $model;

    function _initialize()
    {
        $this->model = $this->getModel('oa_logistics_service');
        parent::_initialize();
        $controller = strtolower(CONTROLLER_NAME);

        $res ['title'] = '后勤中心';
        $res ['url'] = addons_url('OaSystem://OaLogisticsService/lists/type/1', array('mdm' => I('mdm')));
        $res ['class'] = $controller == 'OaLogisticsService' ? 'current' : '';
        $nav [] = $res;
        $this->assign('nav', $nav);

        $res ['title'] = '食堂商品';
        $sub_nav[] = $res;
        $res ['title'] = '小卖部商品';
        $res ['url'] = addons_url('OaSystem://OaLogisticsService/lists/type/2', array('mdm' => I('mdm')));
        $res ['class'] = $controller == 'OaLogisticsService' ? 'current' : '';
        $sub_nav[] = $res;

        $res ['title'] = '票务';
        $res ['url'] = addons_url('OaSystem://OaLogisticsService/lists/type/3', array('mdm' => I('mdm')));
        $res ['class'] = $controller == 'OaLogisticsService' ? 'current' : '';
        $sub_nav[] = $res;

        $res ['title'] = '我的订单';
        $res ['url'] = addons_url('OaSystem://OaServiceOrder/lists', array('mdm' => I('mdm')));
        $res ['class'] = $controller == 'OaServiceOrder' ? 'current' : '';
        $sub_nav[] = $res;

        $this->assign('sub_nav', $sub_nav);
    }
}