<?php

namespace Addons\OaSystem\Controller;
use Think\ManageBaseController;

class OaDutyBaseController extends ManageBaseController
{
    function _initialize()
    {
        parent::_initialize();
        $controller = strtolower(CONTROLLER_NAME);

        $res ['title'] = '职务权限管理';
        $res ['url'] = addons_url('OaSystem://OaDuty/lists', array('mdm' => I('mdm')));
        $res ['class'] = $controller == 'OaDuty' ? 'current' : '';
        $nav [] = $res;
        $this->assign('nav', $nav);

        $res ['title'] = '职务列表';
        $sub_nav[] = $res;
        $res ['title'] = '角色列表';
        $res ['url'] = addons_url('OaSystem://OaRole/lists', array('mdm' => I('mdm')));
        $res ['class'] = $controller == 'OaRole' ? 'current' : '';
        $sub_nav[] = $res;
        $res ['title'] = '职务角色关系';
        $res ['url'] = addons_url('OaSystem://OaRoleDuty/lists', array('mdm' => I('mdm')));
        $res ['class'] = $controller == 'OaRoleDuty' ? 'current' : '';
        $sub_nav[] = $res;

        $res ['title'] = '功能模块';
        $res ['url'] = addons_url('OaSystem://OaNode/lists', array('mdm' => I('mdm')));
        $res ['class'] = $controller == 'OaNode' ? 'current' : '';
        $sub_nav[] = $res;

        $res ['title'] = '角色功能设置';
        $res ['url'] = addons_url('OaSystem://OaRoleNode/lists', array('mdm' => I('mdm')));
        $res ['class'] = $controller == 'OaRoleNode' ? 'current' : '';
        $sub_nav[] = $res;

        $this->assign('sub_nav', $sub_nav);
    }
}