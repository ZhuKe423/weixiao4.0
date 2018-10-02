<?php

namespace Addons\OaSystem\Controller;
use Think\ManageBaseController;

class OaEmpAttendanceController extends ManageBaseController
{
    var $model;

    function _initialize()
    {
        $this->model = $this->getModel('oa_emp_attendance');
        parent::_initialize();
        $controller = strtolower(CONTROLLER_NAME);

        $res ['title'] = '考勤信息';
        $res ['url'] = addons_url('OaSystem://OaEmpAttendance/lists', array('mdm' => I('mdm')));
        $res ['class'] = $controller == 'OaEmpAttendance' ? 'current' : '';
        $nav [] = $res;
        $this->assign('nav', $nav);

        $res ['title'] = '考勤列表';
        $sub_nav[] = $res;
        $res ['title'] = '考勤点管理';
        $res ['url'] = addons_url('OaSystem://OaCheckPoint/lists', array('mdm' => I('mdm')));
        $res ['class'] = $controller == 'OaCheckPoint' ? 'current' : '';
        $sub_nav[] = $res;
        $this->assign('sub_nav', $sub_nav);
    }
}