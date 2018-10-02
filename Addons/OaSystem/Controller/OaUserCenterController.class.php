<?php

namespace Addons\OaSystem\Controller;
use Think\ManageBaseController;

class OaUserCenterController extends ManageBaseController
{
    var $model;

    function _initialize()
    {
        parent::_initialize();
        $controller = strtolower(CONTROLLER_NAME);

        $res ['title'] = '个人中心';
        $res ['url'] = addons_url('OaSystem://OaUserCenter/leavelists', array('mdm' => I('mdm')));
        $res ['class'] = $controller == 'OaUserCenter' ? 'current' : '';
        $nav [] = $res;
        $this->assign('nav', $nav);

        $res ['title'] = '请假申请';
        $sub_nav[] = $res;
        $res ['title'] = '加班申请';
        $res ['url'] = addons_url('OaSystem://OaUserCenter/overworklists', array('mdm' => I('mdm')));
        $res ['class'] = $controller == 'OaRole' ? 'current' : '';
        $sub_nav[] = $res;
        $res ['title'] = '我待办事项';
        $res ['url'] = addons_url('OaSystem://OaUserCenter/myworks', array('mdm' => I('mdm')));
        $res ['class'] = $controller == 'OaRoleDuty' ? 'current' : '';
        $sub_nav[] = $res;
        $this->assign('sub_nav', $sub_nav);
    }

    public function leavelists() {
        $model = $this->getModel('oa_application');
        parent::lists($model);
    }
    public function overworklists(){
        $this->display();
    }

    public function myworks(){
        $this->display();
    }
}