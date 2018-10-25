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
            $bind_count = $this->get_bind_count($user['mobile']);
            $student = $this->get_bind_students($user['mobile']);
            $user['has_subscribe'] = $follow['has_subscribe'];
            $this->assign('user', $user);
            $this->assign('bind_count', $bind_count);
            $this->assign('student', $student);
            $this->assign('school', $this->school);
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

            $this->success ( '绑定成功', $url );
        } else {
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
                $bind_count = $this->get_bind_count($user['mobile']);
                $student = $this->get_bind_students($user['mobile']);
                $user['has_subscribe'] = $follow['has_subscribe'];
                $this->assign('user', $user);
                $this->assign('bind_count', $bind_count);
                $this->assign('student', $student);
                $this->assign ( 'meta_title', '绑定手机' );
                $this->assign('school', $this->school);
                $this->display ('bind_phone');
            }
           ;
        }
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