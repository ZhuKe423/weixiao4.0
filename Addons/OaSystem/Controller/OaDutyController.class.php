<?php

namespace Addons\OaSystem\Controller;
use Addons\OaSystem\Controller\OaDutyBaseController;

class OaDutyController extends OaDutyBaseController
{
    var $model;

    function _initialize()
    {
        $this->model = $this->getModel('oa_duty');
        parent::_initialize();

    }
    function lists(){
        $list_data = $this->_get_model_list( $this->model );
        $this -> assign($list_data);
        $this->display();
    }

    function add(){
        $Model = $this->model;
        parent::add($Model);
    }
}