<?php
/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2018/11/9
 * Time: 10:51
 */

namespace Addons\WeiXiao\Controller;
use Think\ManageBaseController;
use Addons\WeiXiao\Controller\BaseController;

class NotifyController extends BaseController
{
    public function _initialize()
    {
        parent::_initialize();
        if (_ACTION == 'show') {
            $GLOBALS ['is_wap'] = true;
        }

        $this->model = $this->getModel('WxyNotification'); //getModelByName ( $_REQUEST ['_controller'] );
        $this->token = get_token();
        $this->school = D('Common/Apps')->getInfoByToken($this->token, 'public_name');
        $this->schooltype = D('Common/Apps')->getInfoByToken($this->token, 'public_type');
        $this->config = getAddonConfig ( 'WeiXiao' );
        $this->assign('model', $this->model);
    }


    public function notify() {
        $id = I('id');
        $model = M('WxyCourse');

        if (IS_POST) {
            $sendflag = (I('post.msgsend') == "on")?true:false ;
            $allflag = (I('post.allfollower') == "on")?true:false ;
            $info['first_data'] = '本消息反映学校动态，敬请关注。';
            $course = I('post.course');
            $info['keyword1_data'] = substr($course, strpos($course, '. ') + 2);
            $info['remark_data'] = I('post.comment');
            $base_url = 'http://www.jzk12.com/wx4/WeiSite/WeiSite/detail/id/';
            if (strlen(I('post.msgurl')) < 9) {
                $article_id = intval(I('post.msgurl'));
                if ($article_id == 0) $url = '';
                else
                    $url = $base_url . strval($article_id);
            } else {
                $url = I('post.msgurl');
            }
            /*dump ($url);*/
            if (empty($info['remark_data'])) {
                $map['id'] = $article_id;
                $map['token'] = $this->token;
                $data = M('custom_reply_news')->where($map)->find();
                $map['id'] = $data['cate_id'];
                $cate_data = M('weisite_category')->where($map)->find();
                if (empty($cate_data)) $this->error("没有消息发送，请正确填写表单！");
                $cate_data = ($cate_data == null)?'': '【'. $cate_data['title'] . '】';
                $info['remark_data'] = $cate_data . $data['title'] . '，点击查看详情：';
            }
            if ($allflag && $sendflag) {
                if (empty($url))
                    $this->error('文章链接不存在，不能群发此消息！');
                else {
                    $info['keyword1_data'] = '学校动态';
                    $info['keyword2_data'] = '教务老师';
                    $info['title'] = '群发消息';
                    $msg_id = D('WxyNotification')->addMessage($url, $info, $this->token);
                    $this->success('消息群发成功！', U('notify_part', array('msg_id' => $msg_id, 'id' => '0')));
                }
            }
        }
        else {
            empty($id) || $map['id'] = $id;
            $map['status'] = array('lt',3); //有效课程
            $map['token'] = $this->token;
            $data = $model->where($map)->select();
            $this->assign('lists', $data);
            $this->assign('id', $id);
            $this->display('coursenotify');
        }
    }

    public function notify_part() {
        $msg_id = I('msg_id');
        $id = I('id');
        $start = 50 * $id;
        $map['id'] = $msg_id;
        $data = D('WxyNotification')->where($map)->find();
        if (empty($data)) $this->error("消息数据未找到！", U('notify'));
        $info = json_decode($data['message'], true); //JSON to array!
        //dump($info);
        $map1['token'] = $this->token;
        $map1['has_subscribe'] = 1;
        //$map1['uid'] = 190;
        $user_list = M('apps_follow')->where($map1)->limit($start, 50)->select();
        if (empty($user_list)) $this->success("批量发送完毕！", U('notify'));
        foreach ($user_list as $user) {
            $resstr = D('WxyNotification')->send_school_notification_to_user($user['openid'], $data['url'], $info, $this->token);
            //dump($user);
        }
        $id++;
        $this->jump(U('notify_part', array('msg_id' => $msg_id, 'id' => $id)),'正在群发消息，请勿关闭窗口！');
    }

    function jump($url, $msg) {
        $this->assign ( 'url', $url );
        $this->assign ( 'msg', $msg );
        $this->display ( 'jump' );
        exit ();
    }
}