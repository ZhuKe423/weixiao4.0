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
    protected $cat1 = ['1' =>'真题宝典',
                        '2' =>'巧思妙解',
                        '3' =>'每周一拨',
                        '4' =>'等你来嗨',
                        '5' =>'真题',
                        '6' =>'模拟题',
                        '7'  =>'专题',
                        '8' =>'学习方法',
                        '9' =>'通用'];

    protected $cat2 = ['1' => '高中', '2' => '初中', '3' => '小学', '4' => '综合',
                        '7' => '初一',
                        '8' => '初二',
                        '9' => '初三',
                        '10' => '高一',
                        '11' => '高二',
                        '12' => '高三'
                        ];

    protected $cat3 = ['ma' => '数学', 'en' => '英语', 'cn' => '语文', 'ph' => '物理', 'ch' => '化学', 'bi' => '生物'];

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
        $cat1 = I('cat1');
        $cat2 = I('cat2');
        $cat3 = I('cat3');
        $cat1 == '' || $map['type'] = $this->cat1[$cat1];
        $cat2 == '' || $map['stage'] = $this->cat2[$cat2];
        $cat3 == '' || $map['subject'] = $this->cat3[$cat3];
        $data = $model->where($map)->order('id desc')->limit(0,10)->select();
        foreach($data as $key=>$vo) {
            if ((intval($vo['image_id']) == 0) && intval($vo['image_material'])) {
                $cover = D('material_image')->where('id = '. $vo['image_material'])->find();
                $vo['image_id'] = $cover['image_id'];
                $data[$key]['image_id'] = $cover['image_id'];
            }
            if ((intval($vo['image_id']) == 0) && (intval($vo['image_material']) == 0)){
                $data[$key]['image_id'] = 934; //logo
            }
        }
        $title = '【'. $this->school . '】题库';
        $cat1 == '' || $title = $title . '：' . $this->cat1[$cat1];
        $cat2 == '' || $title = $title . '：' . $this->cat2[$cat2];
        $cat3 == '' || $title = $title . '：' . $this->cat3[$cat3];
        $this->assign('page_title', $title);
        $this->assign('cat1', $cat1);
        $this->assign('cat2', $cat2);
        $this->assign('cat3', $cat3);
        $this->assign('data', $data);
        //dump($data);
        $this->display();
    }

    public function lists() {

        $model = D('WxyStudyMaterial');
        if (IS_AJAX || IS_POST) {
            $page = intval(I('post.page'));
            $cat1 = I('post.cat1');
            $cat2 = I('post.cat2');
            $cat3 = I('post.cat3');

            $map['token'] = $this->token;
            $cat1 == '' || $map['type'] = $this->cat1[$cat1];
            $cat2 == '' || $map['stage'] = $this->cat2[$cat2];
            $cat3 == '' || $map['subject'] = $this->cat3[$cat3];

            $row = isset ( $_REQUEST ['list_row'] ) ? intval ( $_REQUEST ['list_row'] ) : 12;
            $data = $model->where($map)->order('id desc')->page ( $page, $row )->select();
            foreach($data as $key=>$vo) {
                if ((intval($vo['image_id']) == 0) && intval($vo['image_material'])) {
                    $cover = D('material_image')->where('id = '. $vo['image_material'])->find();
                    $vo['image_id'] = $cover['image_id'];
                    $data[$key]['image_id'] = $cover['image_id'];
                }
                if ((intval($vo['image_id']) == 0) && (intval($vo['image_material']) == 0)){
                    $data[$key]['image_id'] = 934; //logo
                }
                $data[$key]['image_url'] = get_square_url($data[$key]['image_id'], 200);
                $data[$key]['url'] = U('detail?id='.$vo['id']);
            }
            $this->ajaxReturn($data);
        }
        else {
            $page = I('page');
            $cat1 = I('cat1');
            $cat2 = I('cat2');
            $cat3 = I('cat3');

            $title = '【'. $this->school . '】题库列表';
            $cat1 == '' || $title = $title . "：" . $this->cat1[$cat1];
            $cat2 == '' || $title = $title . "：" . $this->cat2[$cat2];
            $cat3 == '' || $title = $title . "：" . $this->cat3[$cat3];
            $this->assign('page_title', $title);
            $this->assign('cat1', $cat1);
            $this->assign('cat2', $cat2);
            $this->assign('cat3', $cat3);
            $this->display('lists');
        }

        //$this->assign('data', $data);
        //dump($data);

    }

    public function detail()
    {
        $map['uid'] = $this->uid;
        if ($this->uid == 0) { //Not subscribed or not in WeiXin
            $this->error("请微信中打开！");
            return;
        }
        $follow = M("apps_follow")->where($map)->find();
        $user = M("user")->where($map)->find();
        if (($follow == NUll) || ($user == NULL )) { //Not subscribed or not in WeiXin
            $this->error("请微信中打开！");
            return;
        }
        else {
            $user['has_subscribe'] = $follow['has_subscribe'];
            unset($map);
            $map['token'] = $this->token;
            $map['id'] = (I('id') == '') ? 1 : I('id');
            $model = D('WxyStudyMaterial');
            $data = $model->where($map)->find();
            $data['uid'] = $this->uid;
            $this->assign('docid', $map['id']);
            $this->assign('data', $data);
            $this->assign('user', $user);
            $this->assign('page_title', $data['title']);
            $this->display();
        }
    }

    public function send() {
        if (IS_POST) {
            $email = I('post.email');
            $docid = I('post.docid');
            $is_old = (I('post.is_old') == 'true') ? true:false;
            $data['status'] = false;
            if (($email != '') && !$is_old) {
                $map['uid'] = $this->uid;
                $map['token'] = $this->token; //token should be the same
                $user = M("user")->where($map)->find();
                if ($user != null) {
                    $user['email'] = $email;
                    M('user')->where($map)->save($user);
                }
            }
            $map['id'] = $docid;
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
            $download = C('DOWNLOAD_UPLOAD');
            $file_root = $download['rootPath'];
            $sendto_email = $email;
            $subject = $material['title'];
            $body = $material['description'];
            $mapfile['id'] = $material['fileid'];
            $file = M('file')->where($mapfile)->find();
            if ($file != NULL) {
                $attachment = $file_root . $file['savepath'] . $file['savename'];
                $extension_name = substr(strrchr($file['savename'], '.'), 1);
                $attach_name = $material['title'] . '.' . $extension_name;
                /*dump($subject);
                dump($body);*/
                $result = $mail->send_email($sendto_email, $subject, $body, '', $attachment, $attach_name);
                if ($result) $data['status'] = true;
            }
            $this->ajaxReturn($data);
        }
    }

}