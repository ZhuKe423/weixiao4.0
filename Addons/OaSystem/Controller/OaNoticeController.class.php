<?php

namespace Addons\OaSystem\Controller;
use Think\ManageBaseController;

class OaNoticeController extends ManageBaseController
{
    var $model;

    function _initialize()
    {
        $this->model = $this->getModel('oa_notice');
        parent::_initialize();
        $controller = strtolower(CONTROLLER_NAME);

        $res ['title'] = '公告通知信息';
        $res ['url'] = addons_url('OaSystem://OaNotice/lists/type/1', array('mdm' => I('mdm')));
        $res ['class'] = $controller == 'OaNotice' ? 'current' : '';
        $nav [] = $res;
        $this->assign('nav', $nav);

        $res ['title'] = '公告栏';
        $sub_nav[] = $res;
        $res ['title'] = '通知栏';
        $res ['url'] = addons_url('OaSystem://OaNotice/lists/type/2', array('mdm' => I('mdm')));
        $res ['class'] = $controller == 'OaLogisticsService' ? 'current' : '';
        $sub_nav[] = $res;
        $this->assign('sub_nav', $sub_nav);
    }
}