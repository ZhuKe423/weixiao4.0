<?php
/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2018/10/23
 * Time: 17:48
 */

namespace Addons\WeiXiao\Controller;
use Think\WapBaseController;

class WapUcenterController extends WapBaseController
{
    var $syc_wechat = true;
    protected $token;
    protected $school;
    protected $schoolType;
    // 是否需要与微信端同步，目前只有认证的订阅号和认证的服务号可以同步
    function _initialize() {
        parent::_initialize ();
        $this->syc_wechat = C ( 'USER_LIST' );
        $this->token = get_token();
        $this->school = D('Common/Apps')->getInfoByToken($this->token, 'public_name');
        $this->schoolType = D('Common/Apps')->getInfoByToken($this->token, 'public_type');
    }

    public function index() {
        $map['uid'] = $this->uid;
        $map['token'] = $this->token;
        if ($this->uid == 0) { //Not subscribed or not in WeiXin
            $this->error("请微信中打开！");
            return;
        }
        $follow = M("apps_follow")->where($map)->find();
        $user = M("user")->where($map)->find();
        if (($follow == NUll) || ($user == NULL )) { //Not subscribed or not in WeiXin
            $this->error("请微信中打开！");
            return;
        } else {
            $bind_count = $this->get_bind_count($follow['mobile']);
            $student = $this->get_bind_students($follow['mobile']);
            $user['has_subscribe'] = $follow['has_subscribe'];
            $this->assign('user', $user);
            $this->assign('bind_count', $bind_count);
            $this->assign('student', $student);
            $this->assign('school', $this->school);
            $this->assign('page_title', '【'. $this->school . '】：个人中心');
            $this->display();
        }
    }

    // 绑定手机号，用于微校插件手机验证！
    public function bind_phone() {
        if (IS_POST) {
            // 验证码判断
            $check = D('Addons://Sms/Sms')->checkSms(I ( 'mobile' ), I('code'));
            if ($check ['result'] == 0) {
                $this->error($check ['msg']);
                return;
            }
            $map['token'] = $this->token;
            $map ['mobile'] = I ( 'mobile' );
            $token = get_token();
            $openid = get_openid();

            $dao = D ( 'Common/Follow' ); //实际操作的是wp_user表！！
            // 判断是否已经注册过
            $user = $dao->where ( $map )->find ();
            if (! $user) {
                $uid = $dao->init_follow_by_mobile ( $openid, $token, $map ['mobile'] );
                $dao->where ( $map )->setField ( 'status', 0 );
                $user = $dao->where ( $map )->find ();
            }

            $map2 ['openid'] = $openid;
            if ($map2 ['openid'] != - 1) {
                $map2 ['token'] = $token;
                $uid2 = M ( 'apps_follow' )->where ( $map2 )->getField ( 'uid' );
                if (! $uid2) {
                    $map2 ['mobile'] = $map ['mobile'];
                    $map2 ['uid'] = $user ['id'];
                    M ( 'apps_follow' )->add ( $map2 );
                }
                else { // 增加更新操作！
                    $data = M('apps_follow')->where ( $map2 )->find();
                    $data['mobile'] = $map['mobile'];
                    M('apps_follow')->where ( $map2 )->save($data);
                    /*dump($data);
                    dump(M('apps_follow')->getLastSql());*/
                }
            } else { //openid 未取到，则按手机号搜！
                $uid = M ( 'apps_follow' )->where ( $map )->getField ( 'uid' );
                if (! $uid) {
                    $data ['mobile'] = $map ['mobile'];
                    $data ['uid'] = $user ['id'];
                    M ( 'apps_follow' )->add ( $data );
                }
                else { // 增加更新操作！
                    $data ['mobile'] = $map ['mobile'];
                    $data ['uid'] = $uid;
                    M( 'apps_follow')->save($data);
                    /*dump(M('apps_follow')->getLastSql());*/
                }
            }

            session ( 'mid', $user ['id'] );

            if ($user ['status'] == 1) {
                $url = Cookie ( '__forward__' );
                if ($url) {
                    Cookie ( '__forward__', null );
                } else {
                    $url = addons_url('index');
                }
            } else {
                $url = U ( 'index' );
            }
            $url = addons_url("WeiXiao://WapUcenter/index");
            if ($this->token == NULL || $openid == NULL)
                $this->error("请在微信中打开！");

            $s_model = M('WxyStudentCard');
            $s_map['token'] = $this->token;
            $s_map['phone'] = $map['mobile'];
            $s_data = $s_model->where($s_map)->select();
            unset($s_map['phone']);
            $s_map['phone_bck'] = $map['mobile'];
            $s_data = array_merge($s_data, $s_model->where($s_map)->select()); //主用、备用电话学员均采集入数组

            $studentcare_model = D('WxyStudentCare');
            $studentcard_model = D('WxyStudentCard');

            $follow_data = array();
            $studentcare = array();
            $phone = trim(I('post.mobile'));

            $map['openid'] = $user['openid'] = $openid;
            $user['uid'] = $this->uid;

            $follow_model = M('apps_follow');
            $data = $follow_model->where($map)->find();

            $access_token = get_access_token ($this->token);
            $suburl = 'https://api.weixin.qq.com/cgi-bin/user/info?access_token=' . $access_token . '&openid=' . $user ['openid'] . '&lang=zh_CN';
            $userdata = file_get_contents ( $suburl );
            $userdata = json_decode ( $userdata, true );
            //var_dump($userdata);
            //exit();
            if ($data == NULL && $userdata['subscribe'] == 1) {  //追加关注用户
                $follow_data['uid'] = 0;
                $follow_data['openid'] = $map['openid'];
                $follow_data['token'] = $this->token;
                $follow_data['has_subscribe'] = 1;
                $follow_data['syc_status'] = 0;
                $follow_data['remark'] = 'added by student bind';
                $follow_model->add($follow_data); //Add a record for new follower.
                //Need add user data here also TBD.
            }
            else if ($data == NULL && $userdata['subscribe'] == 0)
                $this->error("请关注我们的微信公号后再绑定学生！！！", U('bind'));
            else if ($data != NULL) {
                $data['has_subscribe'] = $userdata['subscribe'];
                if ($userdata['subscribe'] == 0) {
                    $follow_model->where($map)->save($data);
                    $this->error("请关注我们的微信公号后再绑定学生！！！", U('bind'));
                }
                else {
                    $follow_model->where($map)->save($data);
                    $new_bind = 0;
                    $old_bind = 0;
                    //dump($s_data);
                    foreach ($s_data as $key =>$vo) {
                        $student['studentno'] = $vo['studentno'];
                        $student['name'] = $vo['name'];
                        $student['phone'] = $vo['phone'];
                        $student['token'] = $this->token;
                        //$student = $studentcard_model->verify($student);
                        $res = $studentcare_model->approve($student, $user, $this->token);
                        if ($res == 2) $new_bind++;
                        if ($res == 1) $old_bind++;
                    }

                    if ((!$new_bind)&&(!$old_bind)) {
                        $this->error("学生信息有误，或你没有孩子在我校就读！");
                    }
                    else {
                        $str = '';
                        if ($old_bind) $str = $str . "已绑定过" . $old_bind . "名学生";
                        if ($new_bind) $str = $str . "新绑定完成" . $new_bind . "名学生";
                        $this->success("你" . $str . "！", U('index'));
                    }
                }
            }
            //$this->error("学生信息有误，请返回重新输入！");
        } else {
            $map['uid'] = $this->uid;
            $map['token'] = $this->token;
            if ($this->uid == 0) { //Not subscribed or not in WeiXin
                $this->error("请微信中打开！");
                return;
            }
            $follow = M("apps_follow")->where($map)->find();
            $user = M("user")->where($map)->find();
            $user['mobile'] = $follow['mobile']; //Mobile is stored in apps_follow table and can be updated.
            if (($follow == NUll) || ($user == NULL )) { //Not subscribed or not in WeiXin
                $this->error("请微信中打开！");
                return;
            } else {
                $bind_count = $this->get_bind_count_by_uid($this->uid);
                $student = $this->get_bind_students_by_uid($this->uid);
                $user['has_subscribe'] = $follow['has_subscribe'];
                $this->assign('user', $user);
                $this->assign('bind_count', $bind_count);
                $this->assign('student', $student);
                $this->assign ( 'meta_title', '绑定手机' );
                $this->assign('school', $this->school);
                $this->assign('page_title', '【'. $this->school . '】：手机验证');
                $this->display ('bind_phone');
            }
        }
    }

    function get_bind_count_by_uid ($uid = 0) {
        if (($uid == 0) || ($uid == null)) return 0;
        $map0['token'] = $this->token;
        $map0['uid'] = $uid;
        $count0 = D('WxyStudentCareView')->where($map0)->count();
        return $count0;
    }

    function get_bind_students_by_uid ($uid = 0) {
        if (($uid== '') || ($uid == null)) return 0;
        $map0['token'] = $this->token;
        $map0['uid'] = $uid;
        $data0 = D('WxyStudentCareView')->where($map0)->select();
        return $data0;
    }

    function get_bind_count ($phone = '') {
        if (($phone == '') || ($phone == null)) return 0;
        $map0['phone'] = $phone;
        $count0 = D('wxy_student_card')->where($map0)->count();
        $map1['phone_bck'] = $phone;
        $count1 = D('wxy_student_card')->where($map1)->count();
        return $count0 + $count1;
    }

    function get_bind_students ($phone = '') {
        if (($phone == '') || ($phone == null)) return 0;
        $map0['phone'] = $phone;
        $data0 = D('wxy_student_card')->where($map0)->select();
        $map1['phone_bck'] = $phone;
        $data1 = D('wxy_student_card')->where($map1)->select();

        foreach ($data1 as $key=>$vo) {
            array_push($data0, $vo);
        }

        return $data0;
    }
}