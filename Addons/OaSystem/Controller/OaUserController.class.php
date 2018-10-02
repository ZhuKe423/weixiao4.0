<?php

namespace Addons\OaSystem\Controller;
use Think\ManageBaseController;

class OaUserController extends ManageBaseController{
    var $model;
    function _initialize() {
        $this->model = $this->getModel ( 'oa_user' );
        parent::_initialize ();
        $controller = strtolower ( CONTROLLER_NAME );

        $res ['title'] = '员工信息';
        $res ['url'] = addons_url ( 'OaSystem://OaUser/lists' ,array('mdm'=>I('mdm')));
        $res ['class'] = $controller == 'OaUser' ? 'current' : '';
        $nav [] = $res;
        $this->assign ( 'nav', $nav );
    }

    public function lists(){
        $list_data = $this->_get_model_list ( $this->model );
        $this -> assign($list_data);
        $res['title'] = '批量录入';
        $res['is_buttion'] = false;
        $res['url'] = addons_url ( 'OaSystem://OaUser/import' ,array('mdm'=>I('mdm')));
        $top_more_button[] = $res;
        $res['title'] = 'execl 导出';
        $res['is_buttion'] = false;
        $res ['url'] = addons_url ( 'OaSystem://OaUser/export' ,array('mdm'=>I('mdm')));
        $top_more_button[] =$res;

        $this->assign('top_more_button',$top_more_button);
        $this->assign('add_button',false);
        $this->display();
    }

    public function details(){
        $this->display();
    }

    public function import(){
        $res['title'] = '员工信息表';
        $res['is_must'] = true;
        $res['is_show'] = 1;
        $res['name'] = 'employees';
        $res['type'] = 'file';
        $fields []= $res;
        $this->assign('fields',$fields);
        $this->assign('post_url','OaSystem/OaUser/import');
        $this->assign('import_template','template_employees.xlsx');
        $this->display();
    }

    public function export(){
        $this->error("暂时不支持");
    }

}
