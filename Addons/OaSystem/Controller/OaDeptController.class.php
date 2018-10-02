<?php

namespace Addons\OaSystem\Controller;
use Think\ManageBaseController;

class OaDeptController extends ManageBaseController{
    var $model;
    var $appid;
    function _initialize() {
        $this->model = $this->getModel ( 'oa_dept' );
        $this->appid = get_app_info()["appid"];
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
        $list_data = $this->_get_model_list ( $this->model );
        $this -> assign($list_data);
        $this->display();
    }

    function add(){
        if (IS_POST) {
            $deptModel = D('oa_dept');
            $data = $_POST;
            $data['appid'] = $this->appid;

            $map['appid'] = $this->appid;
            $map['dept_no'] = $_POST['dept_no'];
            $res = M('oa_dept')->where($map)->find();
            if($res != null){
                $this->success ( '创建' . $model ['title'] . '失败！部门编号已存在', U ( 'lists?model=' . $model ['name'], $this->get_param ));
            }else{
                $ret = $deptModel->updateDept($data);
                if ($ret != null) {
                    $this->success ( '保存' . $model ['title'] . '成功！', U ( 'lists?model=' . $model ['name'], $this->get_param ));
                }else{
                    $this->success ( '创建' . $model ['title'] . '失败！', U ( 'lists?model=' . $model ['name'], $this->get_param ));
                }
            }
        } else {
            $data['grade'] = M ( 'oa_dept_grade' )->select ();
            $data['dept'] = M ( 'oa_dept' )->select ();
            $res['name'] = '无父级部门';
            $res['id'] = 0;
            array_unshift($data['dept'],$res);
            $this->assign ( 'grade', $data['grade'] );
            $this->assign ( 'dept', $data['dept']);
            $this->assign ( 'post', $data['dept']);
            $this->display();
        }
    }

    function show(){
        $this->display();
    }
}
