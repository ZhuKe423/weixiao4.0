<?php

namespace Addons\WeiXiao\Controller;
use Think\ManageBaseController;

class StudymaterialController extends ManageBaseController{
    protected $model;
    protected $token;
    protected $school;
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

    function _initialize() {
        parent::_initialize ();
        $act = strtolower ( ACTION_NAME );

        $res ['title'] = '列表';
        $res ['url'] = U ( 'lists' );
        $res ['class'] = $act == 'lists' ? 'current' : '';
        $nav [] = $res;

        $res ['title'] = '新增';
        $res ['url'] = U ( 'add' );
        $res ['class'] = $act == 'add' ? 'current' : '';
        $nav [] = $res;

        if ($act == 'add') {
            $res ['title'] = '编辑菜单';
            $res ['url'] = '###';
            $res ['class'] = 'current';
            $nav [] = $res;
        }

        $this->assign ( 'nav', $nav );
    }

    /**
     * 显示指定模型列表数据
     */
    public function lists()
    {
        parent::common_lists($this->model);
    }

    public function add() {
        //$this->assign('token',$this->token);
        if (IS_POST) {
            $data['type'] = I('post.type');
            $data['stage'] = I('post.stage');
            $data['subject'] = I('post.subject');
            $data['fileid'] = I('post.file_id');
            $data['title'] = I('post.title');
            $data['description'] = I('post.description');
            $data['image_id'] = I('post.image_id');
            $data['image_material'] = I('post.image_material');
            $data['token'] = $this->token;

            $model = D('WxyStudyMaterial');
            $map['fileid'] = $data['fileid'];
            if ($model->where($map)->select()) {
                $this->error("文件已经存在，请重新上传文件。");
            }
            else
                if ($data['fileid'] != 0) {
                    $model->add($data);
                    $this->success("资料提交成功，刷新后可继续提交");
                }
                else
                    $this->error("文件上传错误，请成功上传文件后再提交表单");

        }
        else {
            $fields = get_model_attribute ( $this->model ['id'] );

            $this->assign ( 'fields', $fields );
            $this->meta_title = '新增' . $this->model ['title'];

            $this->display();
        }

    }

    public function edit() {
        //$this->assign('token',$this->token);
        if (IS_POST) {
            $data['type'] = I('post.type');
            $data['stage'] = I('post.stage');
            $data['subject'] = I('post.subject');
            $data['fileid'] = I('post.file_id');
            $data['title'] = I('post.title');
            $data['description'] = I('post.description');
            $data['image_id'] = I('post.image_id');
            $data['image_material'] = I('post.image_material');
            $data['token'] = $this->token;

            $model = D('WxyStudyMaterial');
            $map['fileid'] = $data['fileid'];
            if ($model->where($map)->select()) {
                $this->error("文件已经存在，请重新上传文件。");
            }
            else
                if ($data['fileid'] != 0) {
                    $model->add($data);
                    $this->success("资料提交成功，刷新后可继续提交");
                }
                else
                    $this->error("文件上传错误，请成功上传文件后再提交表单");

        }
        else {
            /*$fields = get_model_attribute ( $this->model ['id'] );
            $this->assign ( 'fields', $fields );
            //$this->meta_title = '新增' . $this->model ['title'];
            $map['id'] = I('id');
            $map['token'] = $this->token;
            $model = D('WxyStudyMaterial');
            $data = $model->where($map)->find();
            if ($data != NUll ) {
                $this->display('add');
                $this->assign('data', $data);
            }
            else $this->error('记录不存在，请确认ID号');*/
            parent::common_edit($this->model);
        }
    }

    // 通用插件的删除模型
    public function del() {
        parent::common_del ( $this->model );
    }


    public function send () {
        if (1) {
            $map['id'] = I('id');
            //var_dump($fileid);
            require_once(VENDOR_PATH . '/phpmailer/MailModel.class.php');
            $mail = new \MailModel ();
            $mail->option = array(
                'email_sendtype' => C('email_sendtype'),
                'email_host' => C('email_host'),
                'email_port' => C('email_port'),
                'email_ssl' => C('email_ssl'),
                'email_account' => C('email_account'),
                'email_password' => C('email_password'),
                'email_sender_name' => C('email_sender_name'),
                'email_sender_email' => C('email_sender_email'),
                'email_reply_account' => C('email_sender_email')
            );

            $mail->option['email_sender_name'] = $this->school;
            //var_dump($mail->option);
            $material = D('WxyStudyMaterial')->where($map)->find();
            $mail_list = D('WxyStudyOrder')->where(1)->select();//order_list($material['stage']);
            $download = C('DOWNLOAD_UPLOAD');
            $file_root = $download['rootPath'];
            $count = 0;
            $count_ok = 0;
            dump($mail_list);
            dump($file_root);
            dump($material);
            foreach ($mail_list as $vo) {
                $sendto_email = $vo['email'];
                $subject = $material['title'];
                $body = $material['description'];
                $mapfile['id'] = $material['fileid'];
                $file = M('file')->where($mapfile)->find();
                if ($file != NULL) {
                    $attachment = $file_root . $file['savepath'] . $file['savename'];
                    $extension_name = substr(strrchr($file['savename'], '.'), 1);
                    $attach_name = $material['title'] . '.' . $extension_name;
                    dump($sendto_email);
                    /*dump($subject);
                    dump($body);*/
                    dump($attachment);
                    $result = $mail->send_email($sendto_email, $subject, $body, '', $attachment, $attach_name);
                    $count++;
                    if ($result) $count_ok++;
                }
            }

            die();
            $this->success("邮件总共发送". strval($count)."封，其中成功发送".strval($count_ok)."封。");
        }
    }
}
