<?php

namespace Addons\OaSystem\Controller;
use Think\ManageBaseController;

class OaDeptGradeController extends ManageBaseController{
    var $model;
    function _initialize() {
        $this->model = $this->getModel ( 'oa_dept_grade' );
        parent::_initialize ();
        $controller = strtolower ( CONTROLLER_NAME );

        $res ['title'] = '部门信息';
        $res ['url'] = addons_url ( 'OaSystem://OaDept/lists' ,array('mdm'=>I('mdm')));
        $res ['class'] = $controller == 'OaDept' ? 'current' : '';
        $nav [] = $res;
        $this->assign ( 'nav', $nav );

        $res ['title'] = '部门列表';
        $sub_nav[] = $res;
        $res ['title'] = '部门等级';
        $res ['url'] = addons_url ( 'OaSystem://OaDeptGrade/lists' ,array('mdm'=>I('mdm')));
        $res ['class'] = $controller == 'OaDept' ? 'current' : '';
        $sub_nav[] = $res;
        $res ['title'] = '部门关系';
        $res ['url'] = addons_url ( 'OaSystem://OaDept/show' ,array('mdm'=>I('mdm')));
        $res ['class'] = $controller == 'OaDept' ? 'current' : '';
        $sub_nav[] = $res;
        $this->assign ( 'sub_nav', $sub_nav );
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