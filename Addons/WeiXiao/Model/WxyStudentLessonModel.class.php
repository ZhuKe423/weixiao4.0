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
        foreach($data['out'] as $key =>$lesson_list) {
            $l_map['token'] = $token;
            $l_map['courseid'] = $key;
            $l_map['studentno'] = $studentno;
            $out_lesson_data = $this->where($l_map)->select(); //student_lesson not recorded.
            if (empty($out_lesson_data)) {
                $no_student_lesson = true;
            }
            else {
                foreach ($lesson_list as $lesson_id) {
                    $map['lesson_id'] = $lesson_id;
                    $this->where($l_map)->delete();
                }
            }
        };

        if ($no_student_lesson) {
            foreach ($data['out'] as $key => $lesson_list) {
                $l_map['token'] = $token;
                $l_map['courseid'] = $key;
                $l_map['studentno'] = $studentno;
                $student_course = D('WxyStudentCourse')->where($l_map)->find();
                $student_course['status'] = 1;
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
            };
        }


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
                    if (empty($this->where($in_lesson_data)->find())) {
                        $this->add($in_lesson_data);
                        $student_course_new['token'] = $token;
                        $student_course_new['studentno'] = $studentno;
                        $student_course_new['sid'] = $sid;
                        $student_course_new['courseid'] = $in_lesson_data['courseid'];
                        $student_course_new['bat_no'] = $in_lesson_data['bat'];
                        if (empty(D('WxyStudentCourse')->where($student_course_new)->find())) {
                            $student_course_new['status'] = 2; // changed by in-adj
                            $student_course_new['opcode'] = 2; // changed by in-adj.
                            $student_course_new['timestamp'] = time();
                            M('WxyStudentCourse')->add($student_course_new);
                        }
                    }
                }
            };
        }
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
}