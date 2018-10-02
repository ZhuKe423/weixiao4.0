<?php

namespace Addons\OaSystem\Controller;
use Think\ManageBaseController;

class OaApplicationController extends ManageBaseController
{
    var $model;

    function _initialize()
    {
        $this->model = $this->getModel('oa_application');
        parent::_initialize();
        $controller = strtolower(CONTROLLER_NAME);

        $res ['title'] = '报销审批';
        $res ['url'] = addons_url('OaSystem://OaApplication/lists', array('mdm' => I('mdm')));
        $res ['class'] = $controller == 'OaApplication' ? 'current' : '';
        $nav [] = $res;
        $this->assign('nav', $nav);
    }

    public function leavelists() {
        parent::lists();
    }
}