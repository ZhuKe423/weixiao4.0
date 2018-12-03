<?php
/**
 * Created by PhpStorm.
 * User: kezhu
 * Date: 2018/11/28
 * Time: 09:21
 */
namespace Addons\WeiXiao\Controller;

use Think\Controller;

class StudentAttendanceController extends Controller
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

        $this->token = get_token();
        $this->school = D('Common/Apps')->getInfoByToken($this->token, 'public_name');
        $this->schoolType = D('Common/Apps')->getInfoByToken($this->token, 'public_type');
        $this->config = getAddonConfig('WeiXiao');

    }

    public function get_stduent_name () {
        $studentNo = I('studentNo');
        $studentInfo = M('WxyStudentCard')->where(array('studentno'=>$studentNo))->find();
        if (empty($studentInfo)) {
            $res['status'] = 0;
            echo json_encode($res);
        }else{
            $res['status'] = 1;
            $res['studentNo'] = $studentInfo['studentno'];
            $res['studentName'] = $studentInfo['name'];
            return $this->ajaxReturn($res,'JSON');
        }
    }

    public function add_from_zkfinger_client() {
        $_post = I('post.');
        if (IS_POST) {
            $studentNo = $_post['studentNo'];
            $studentName = $_post['studentName'];
            $data['fingerId'] =  $_post['fingerId'];
            $data['fingerName'] = $_post['fingerName'];
            $data['fingerModelSize'] = $_post['fingerModelSize'];
            $data['fingerModel'] = $_post['fingerModel'];

            $stu_badge = M('WxyStudentBadge')->where(array('studentno'=>$studentNo,'token'=>$this->token))->find();

            if (empty($stu_badge)) {
                $stu_badge['studentno'] = $studentNo;
                $stu_badge['token'] = $this->token;
                $stu_badge['type'] = 2; // finger type
                $stu_badge['name'] = $studentName;
                $finger[] = $data;
                $stu_badge['finger'] = json_encode($finger);
                $stu_badge['updatetime'] = NOW_TIME;
                $ret = M('WxyStudentBadge')->add($stu_badge);
            }else {
                $oldFingers = json_decode($stu_badge['finger'],true);
                $oldFingerIds = array_column($oldFingers,'fingerId');
                $findIndex = array_search($data['fingerId'],$oldFingerIds);
                if ($findIndex === false) {
                    $oldFingers[] = $data;
                }else{
                    $oldFingers[$findIndex] = $data;
                }
                $stu_badge['name'] = $studentName;
                $stu_badge['type'] = 2; // finger type
                $stu_badge['finger'] = json_encode($oldFingers);
                $stu_badge['updatetime'] = NOW_TIME;
                $ret = M('WxyStudentBadge')->save($stu_badge);
            }
            $res['status'] = empty($ret)?0:1;
            $res['data'] = $ret;
            return $this->ajaxReturn($res,'JSON');
        } else {
            $res['status'] = 0;
            $res['msg'] = "this is a post API!";
            return $this->ajaxReturn($res,'JSON');
        }
    }

    public function updateStudent() {
        if (IS_POST) {
            if (empty(I('post.token')) || empty(I('post.SN'))){
                $ret['status'] = false;
                return $this->ajaxReturn($ret,'JSON');
            }
            $sn = I('post.SN');
            $token = I('post.token');
            $studentBadges = D('WxyStudentBadge')->get_studentBadgeByRoomClock($sn,$token);

            $iclockUsers = array();
            $iclockUsers['timeStamp'] = NOW_TIME;
            $iclockUsers['SN'] = $sn;
            foreach ($studentBadges as $studentBadge) {
                $tmp['PIN'] = $studentBadge['studentno'];
                $tmp['Name'] = $studentBadge['name'];
                $tmp['Pri'] = $studentBadge['priority'];
                $tmp['Passwd'] = '123';
                $tmp['Card'] = $studentBadge['cardno'];
                $tmp['Grp'] = '1';
                $tmp['TZ'] = '0001000100000000';
                $fingers = json_decode($studentBadge['finger'],true);
                foreach ($fingers as $finger) {
                    $fid['FID'] = intval($finger["fingerId"]);
                    $fid['Size'] = intval($finger["fingerModelSize"]);
                    $fid['TMP'] = $finger["fingerModel"];
                    $fid['Valid'] = 1;
                    $tmp['fingers'][] = $fid;
                }
                $iclockUsers['users'][] = $tmp;
            }

            return $this->ajaxReturn($iclockUsers,'JSON');
        } else {
            $res['status'] = 0;
            $res['msg'] = "this is a post API!";
            return $this->ajaxReturn($res,'JSON');
        }

    }

    public function newRecord() {
        if (IS_POST) {
            if (empty(I('post.token')) || empty(I('post.SN')) || empty(I('post.record'))){
                $ret['status'] = false;
                echo json_encode($ret);
            }
        }

        $clock_sn = I('post.SN');
        $token = I('post.token');
        $record = json_decode(I('post.record'), true);
        $studentno = $record['PIN'];
        $recordTimeStamp = strtotime($record['TIME']);
        $iclock = M('WxyCheckPosition')->where(array('sn'=>$clock_sn,'token'=>$token))->find();

        $response = array();
        $studentLessons = D('WxyStudentLesson')->get_student_lesson_by_datetime($token,$studentno,$iclock['room'],$iclock['site'],$recordTimeStamp);
        foreach ($studentLessons as $studentLesson) {
            $clockStart = strtotime($studentLesson['classdate']) - 30 * 60;
            $clockEnd = strtotime($studentLesson['classdate']) + 60 * 60;
            if (($recordTimeStamp > $clockStart) && ($recordTimeStamp < $clockEnd)) {
                $ret = D('WxyDailyTime')->add_attendance_recode($token,$studentno,$recordTimeStamp,intval($iclock['id']),intval($studentLesson['lesson_id']));
                if (!empty($ret)) {
                    $response['status'] = 1;
                    $response['data'] = $ret;
                }
                break;
            }
        }
        return $this->ajaxReturn($response,'JSON');
    }

    public function syncRecord () {
        if (IS_POST) {
            if (empty(I('post.token')) || empty(I('post.SN')) || empty(I('post.records'))){
                $ret['status'] = false;
                echo json_encode($ret);
            }
        }
        $clock_sn = I('post.SN');
        $token = I('post.token');
        $records = json_decode(I('records'), true);

        $iclock = M('WxyCheckPosition')->where(array('sn'=>$clock_sn,'token'=>$token))->find();
        foreach ($records as $record) {
            $recordTimeStamp = strtotime($record['TIME']);
            $studentno = $record['PIN'];
            $studentLessons = D('WxyStudentLesson')->get_student_lesson_by_datetime($token,$studentno,$iclock['room'],$iclock['site'],$recordTimeStamp);
            foreach ($studentLessons as $studentLesson) {
                $clockStart = strtotime($studentLesson['classdate']) - 30 * 60;
                $clockEnd = strtotime($studentLesson['classdate']) + 60 * 60;
                if (($recordTimeStamp > $clockStart) && ($recordTimeStamp < $clockEnd)) {
                    D('WxyDailyTime')->add_attendance_recode($token,$studentno,$recordTimeStamp,intval($iclock['id']),intval($studentLesson['lesson_id']));
                }
            }
        }
        $response['status'] = 1;
        return $this->ajaxReturn($response,'JSON');
    }

    public function getCommand() {
        $response['status'] = 1;
        $response['msg'] = "There is no command !!";
        return $this->ajaxReturn($response,'JSON');
    }
}