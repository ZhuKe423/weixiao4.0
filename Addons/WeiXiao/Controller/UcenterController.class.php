<?php
/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2018/10/24
 * Time: 20:35
 */

namespace Addons\WeiXiao\Controller;
use Think\ManageBaseController;

class UcenterController extends ManageBaseController
{
    protected $model;
    protected $token;
    protected $school;
    protected $schoolType;
    public function __construct() {
        if (_ACTION == 'show') {
            $GLOBALS ['is_wap'] = true;
        }

        parent::__construct ();
        $this->model = $this->getModel('WxyUserRole'); //getModelByName ( $_REQUEST ['_controller'] );
        $this->token = get_token();
        $this->school = D('Common/Apps')->getInfoByToken($this->token, 'public_name');
        $this->schoolType = D('Common/Apps')->getInfoByToken($this->token, 'public_type');
    }
    public function add() {
        //dump($this->model);
        $data['token'] = $this->token;
        $this->assign('data', $data);
        parent::common_add($this->model);
    }

    public function edit() {
        parent::common_edit($this->model);
    }

    public function lists() {
        parent::common_lists($this->model);
    }
}