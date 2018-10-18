<?php
/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2018/10/16
 * Time: 16:23
 */

namespace Addons\WeiXiao\Controller;

use Think\WapBaseController;
class WapStudymaterialController extends WapBaseController
{
    public function __construct() {
        if (_ACTION == 'show') {
            $GLOBALS ['is_wap'] = true;
        }
        parent::__construct ();
        $this->model = $this->getModel('WxyStudyMaterial'); //getModelByName ( $_REQUEST ['_controller'] );
        $this->token = get_token();
        $this->school = D('Common/Apps')->getInfoByToken($this->token, 'public_name');
        /*var_dump($this->model);
        var_dump($_REQUEST ['_controller']);

        exit();
        $this->model || $this->error ( '模型不存在！' );
        */
        $this->assign ( 'model', $this->model );
    }

    public function index() {
        $model = D('WxyStudyMaterial');
        $data = $model->order('id desc')->limit(0,10)->select();
        foreach($data as $key=>$vo) {
            if ((intval($vo['image_id']) == 0) && intval($vo['image_material'])) {
                $cover = D('material_image')->where('id = '. $vo['image_material'])->find();
                $vo['image_id'] = $cover['image_id'];
            }
            if ((intval($vo['image_id']) == 0) && (intval($vo['image_material']) == 0)){
                $data[$key]['image_id'] = 934; //logo
            }
        }
        $this->assign('data', $data);
        //dump($data);
        $this->display();
    }

    public function detail()
    {
        $map['token'] = $this->token;
        $map['id'] = (I('id') == '')? 1 : I('id');
        $model = D('WxyStudyMaterial');
        $data = $model->where($map)->find();
        $this->assign('data', $data);
        $this->display();
    }

}