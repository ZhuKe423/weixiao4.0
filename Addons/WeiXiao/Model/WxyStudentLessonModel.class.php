<?php
/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2018/11/27
 * Time: 10:51
 */

namespace Addons\Weixiao\Model;
use Think\Model;

class WxyStudentLessonModel extends Model
{
    protected $tableName = 'wxy_student_lesson';

    public function reschedule($token, $studentno, $data) {
        if (count($data['out']) < count($data['in'])) return false; //调入课时大于调出课时。
        $map['token'] = $token;
        $s_map['token'] = $token;
        $s_map['studentno'] = $studentno;
        $s_data = D('WxyStudentCard')->where($s_map)->find();
        $sid = $s_data['id'];
        $sname = $s_data['name'];
        $no_student_lesson = false;
        /*foreach($data['out'] as $key =>$lesson_list) {
            $l_map['token'] = $token;
            $l_map['courseid'] = $key;
            $l_map['studentno'] = $studentno;
            $out_lesson_data = $this->where($l_map)->select(); //student_lesson not recorded.
            if (empty($out_lesson_data)) {
                $no_student_lesson = true;
            }
            else {
                foreach ($lesson_list as $lesson_id) {
                    $l_map['lesson_id'] = $lesson_id;
                    $this->where($l_map)->delete();
                }
                $no_student_lesson = false;
            }
        };*/


        foreach ($data['out'] as $key => $lesson_list) {
            $l_map['token'] = $token;
            $l_map['courseid'] = $key;
            $l_map['studentno'] = $studentno;
            $out_student_lesson = $this->where($l_map)->select(); //student_lesson not recorded.
            if (empty($out_student_lesson)) {
                $no_student_lesson = true;
            }
            else {
                foreach ($lesson_list as $lesson_id) {
                    $l_map['lesson_id'] = $lesson_id;
                    $this->where($l_map)->delete();
                }
                unset($l_map['lesson_id']);
                if (empty($this->where($l_map)->select()))
                    D('WxyStudentCourse')->where($l_map)->delete();
                $no_student_lesson = false;
            }

            if ($no_student_lesson) {
                $student_course = D('WxyStudentCourse')->where($l_map)->find();
                $student_course['status'] = 1; //out rescheduled
                $student_course['opcode'] = 2; //ever rescheduled
                $student_course_new['timestamp'] = time();
                D('WxyStudentCourse')->where($l_map)->save($student_course); //update the status to changed.
                $Model = D('WxyStudentLessonView');
                $out_lesson_data = D('WxyStudentLessonView')->where($l_map)->select();
                $map['courseid'] = $key;
                $map['studentno'] = $studentno;
                foreach ($lesson_list as $lesson_id) {
                    $map['lesson_id'] = $lesson_id;
                    $out_lesson = $Model->where($map)->find();
                    if (!empty($out_lesson)) {
                        $key_del = array_search($out_lesson, $out_lesson_data);
                        unset($out_lesson_data[$key_del]);
                    }
                };
                $in_lesson_data['token'] = $token;
                $in_lesson_data['sid'] = $sid;
                $in_lesson_data['status'] = '0';
                $in_lesson_data['studentno'] = $studentno;
                foreach($out_lesson_data as $lesson_key => $lesson_item) {
                    $in_lesson_data['courseid'] = $lesson_item['courseid'];
                    $in_lesson_data['lesson_id'] = $lesson_item['lesson_id'];
                    $in_lesson_data['bat'] = $lesson_item['bat'];
                    //dump($in_lesson_data);
                    $result = $this->where($in_lesson_data)->find();
                    if (empty($result)) $this->add($in_lesson_data);
                }
            }
        };

        unset($map);
        foreach($data['in'] as $key => $lesson_list) {
            $Model = D('WxyCourseLessonView');
            $map['courseid'] = $key;
            $map['token'] = $token;
            foreach ($lesson_list as $lesson_id) {
                $map['lesson_id'] = $lesson_id;
                $lesson_item = $Model->where($map)->find();
                if (!empty($lesson_item)) {
                    $in_lesson_data['token'] = $token;
                    $in_lesson_data['sid'] = $sid;
                    $in_lesson_data['status'] = '0';
                    $in_lesson_data['studentno'] = $studentno;
                    $in_lesson_data['courseid'] = $lesson_item['courseid'];
                    $in_lesson_data['lesson_id'] = $lesson_item['lesson_id'];
                    $in_lesson_data['bat'] = $lesson_item['bat'];
                    //$in_lesson_data['timestamp'] = time();
                    if (empty($this->where($in_lesson_data)->find())) {
                        $this->add($in_lesson_data);
                        $student_course_new['token'] = $token;
                        $student_course_new['studentno'] = $studentno;
                        $student_course_new['sid'] = $sid;
                        $student_course_new['courseid'] = $in_lesson_data['courseid'];
                        $student_course_new['bat_no'] = $in_lesson_data['bat'];
                        if (empty(D('WxyStudentCourse')->where($student_course_new)->find())) {
                            $student_course_new['status'] = 2; // changed by in-adj
                            $student_course_new['opcode'] = 2; // ever rescheduled
                            $student_course_new['timestamp'] = time();
                            M('WxyStudentCourse')->add($student_course_new);
                        }
                        else {
                            $student_course_new['status'] = 2; // changed by in-adj
                            $student_course_new['opcode'] = 2; // ever rescheduled
                            $student_course_new['timestamp'] = time();
                            M('WxyStudentCourse')->save($student_course_new);
                        }
                    }
                }
            };
        }
        return true;
    }

    public function get_student_lesson_by_course($studentno, $courseid, $token) {
        $map["courseid"] = $courseid;
        $map["studentno"] = $studentno;
        $map["token"] = $token;

        $data = D('WxyStudentRawLessonView')->where($map)->order('lesson_id asc')->select();
        if (empty($data)) {
            $model = D("WxyStudentLessonView");
            $data = $model->where($map)->order('sequence asc')->select();
        }
        return $data;
    }

    public function get_student_lesson_by_datetime($token, $studentno, $room, $site, $dateTime) {
        $dateStart = date("Y-m-d 00:00:00", $dateTime);
        $dateEnd = date("Y-m-d 23:59:59", $dateTime);
        $map['classdate'] = array('between',array($dateStart,$dateEnd));
        $map['token'] = $token;
        $map['studentno'] = $studentno;
        $map['room'] = $room;
        $map['site'] = $site;
        //var_dump($map);
        $studentDateLessons = D('WxyStudentLessonView')->where($map)->select();

        foreach ($studentDateLessons as $key =>$vo ) {
            if ($vo['status'] > 0) {
                $map['lesson_id'] = $vo['lesson_id'];
                $tmp = D('wxyStudentRawLessonView')->where($map)->find();
                if (empty($tmp)) {
                    unset($studentDateLessons[$key]);
                }else{
                    $studentDateLessons[$key] = $tmp;
                }
            }
        };
        return $studentDateLessons;
    }

    public function get_lesson_data_by_room_datetime($token, $room, $site, $dateTime) {
        $dateStart = date("Y-m-d 00:00:00",$dateTime);
        $dateEnd = date("Y-m-d 23:59:59",$dateTime);
        $map['classdate'] = array('between',array($dateStart,$dateEnd));
        $map['token'] = $token;
        $map['room'] = $room;
        $map['site'] = $site;
        $studentDateLessons = D('WxyStudentLessonView')->where($map)->select();

        foreach ($studentDateLessons as $key =>$vo ) {
            if ($vo['status'] > 0) {
                $map['lesson_id'] = $vo['lesson_id'];
                $tmp = D('wxyStudentRawLessonView')->where($map)->find();
                if (empty($tmp)) {
                    unset($studentDateLessons[$key]);
                }else{
                    $studentDateLessons[$key] = $tmp;
                }
                $clockRange = [
                    strtotime($studentDateLessons[$key]['classdate']) - 30 * 60,
                    strtotime($studentDateLessons[$key]['classdate']) + 60 * 60
                ];
                $studentDateLessons[$key]['clockRange'] = $clockRange;
            }
        };
        return $studentDateLessons;
    }

















}