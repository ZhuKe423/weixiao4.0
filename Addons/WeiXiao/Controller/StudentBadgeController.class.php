<?php
/**
 * Created by PhpStorm.
 * User: kezhu
 * Date: 2018/11/28
 * Time: 09:21
 */
namespace Addons\WeiXiao\Controller;

use Think\ManageBaseController;

class StudentBadgeController extends ManageBaseController
{
    protected $model;
    protected $token;
    protected $school;
    protected $schoolType;

    public function __construct()
    {

        if (_ACTION == 'show') {
            $GLOBALS ['is_wap'] = true;
        }
        parent::__construct();

        $this->model = $this->getModel('WxyStudentBadge');
        $this->token = get_token();
        $this->school = D('Common/Apps')->getInfoByToken($this->token, 'public_name');
        $this->schoolType = D('Common/Apps')->getInfoByToken($this->token, 'public_type');
        $this->config = getAddonConfig('WeiXiao');

    }

    public function _initialize()
    {
        parent::_initialize();
        $act = strtolower(ACTION_NAME);

        $res ['title'] = '考勤卡基础信息列表';
        $res ['url'] = U('lists');
        $res ['class'] = $act == 'lists' ? 'current' : '';
        $nav [] = $res;

        $this->assign('nav', $nav);
    }

    /**
     * 显示指定模型列表数据
     */
    public function  lists() {
        $list_data = parent::_get_model_list($this->model,0,'');
        $boitype = array('','射频卡','指纹识别','面部识别');
        for ($i = 0; $i < count($list_data['list_data']); $i++) {
            $fingerModels = json_decode($list_data['list_data'][$i]['finger'],true);
            $fingerNameStr = '已录入：';
            $fingerNames = array_column($fingerModels,'fingerName');
            $fingerNameStr .= implode(";",$fingerNames);
            $list_data['list_data'][$i]['finger'] = $fingerNameStr;
            $list_data['list_data'][$i]['type'] = $boitype[$list_data['list_data'][$i]['type']];
        }

        $this->assign ( $list_data );
        $this->assign ('add_button',false);
        $this->assign ('del_button',false);
        $this->assign ('placeholder',"请输入学生学号");
        $this->assign ('search_key',"studentno");
        $this->display ();
    }

}