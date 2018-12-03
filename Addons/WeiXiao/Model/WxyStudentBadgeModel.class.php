<?php

namespace Addons\Weixiao\Model;
use Think\Model;

/**
 * Student_Card模型
 */
class WxyStudentBadgeModel extends Model {
    public function get_studentBadgeByRoomClock ($clock_sn, $token, $status = 0) {
        $iclock = M('WxyCheckPosition')->where(array('sn'=>$clock_sn,'token'=>$token))->find();
        $courseLessonMap['room'] = $iclock['room'];
        $courseLessonMap['site'] = $iclock['site'];
        $courseLessonMap['token'] = $token;
        $courseLessonMap['classdate'] = array('egt',date("Y-m-d H:i:s"));

        $lessonsData = D('WxyCourseLessonView')->where($courseLessonMap)->select();
        $lessonIds = array_column($lessonsData,'lesson_id');
        $courseIds = array_column($lessonsData,'courseid');

        $studentLessonMap['token'] = $token;
        $studentLessonMap['lesson_id'] = array('in',$lessonIds);
        $studentLessonData = M('WxyStudentLesson')->where($studentLessonMap)->select();
        $students = array_column($studentLessonData,'studentno');

        $studentCourseMap['token'] = $token;
        $studentCourseMap['courseid'] = array('in',$courseIds);
        $studentCourseData = M('WxyStudentCourse')->where($studentCourseMap)->select();
        $students = array_merge($students,array_column($studentCourseData,'studentno'));
        $students = array_unique($students);
        $students = array_merge($students);

        // echo json_encode($students);
        $map['studentno'] = array('in',$students);
        $data = $this->where($map)->select();
        return $data;
    }
}