<?php
/**
 * Created by PhpStorm.
 * User: kezhu
 * Date: 2018/11/28
 * Time: 09:21
 */
namespace Addons\WeiXiao\Controller;

use Think\ManageBaseController;

class CheckPositionController extends ManageBaseController
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

        $this->model = $this->getModel('WxyCheckPosition');
        $this->token = get_token();
        $this->school = D('Common/Apps')->getInfoByToken($this->token, 'public_name');
        $this->schoolType = D('Common/Apps')->getInfoByToken($this->token, 'public_type');
        $this->config = getAddonConfig('WeiXiao');

    }

    public function _initialize()
    {
        parent::_initialize();
        $act = strtolower(ACTION_NAME);

        $res ['title'] = '考勤机位置信息列表';
        $res ['url'] = U('lists');
        $res ['class'] = $act == 'lists' ? 'current' : '';
        $nav [] = $res;

        $this->assign('nav', $nav);
    }

    /**
     * 显示指定模型列表数据
     */
    public function  lists() {
       parent::common_lists($this->model);
    }

    public function add() {
        $_POST['token'] = $this->token;
        parent::common_add($this->model);
    }

    public function edit() {
        $_POST['token'] = $this->token;
        parent::common_edit($this->model);
    }
}