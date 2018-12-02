<?php
/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2018/11/2
 * Time: 18:05
 */

namespace Addons\WeiXiao\Model;
use Think\Model;

class WxyCourseLessonModel extends Model
{
    protected $tableName = 'wxy_course_lesson';
    function addCourseLesson($data) {
        $map['token'] = $data['token'];
        $map['courseid'] = $data['courseid'];
        $map['classdate'] = $data['classdate'];
        $map['site'] = $data['site'];
        $map['bat'] = $data['bat'];
        $result = $this->where($map)->find();
        if ($data['courseid'] == '') return;
        if (!$result) {
            $this->add($data);
        }
    }

    public function get_course_lesson_by_date($dateTime) {
        $key = 'courseLesson_ON_date_'.date("Y-m-d",$dateTime);
        $dateLessons = S ( $key );
        if ($dateLessons === false || empty($dateLessons)) {
            $dateStart = date("Y-m-d 00:00:00",$dateTime);
            $dateEnd = date("Y-m-d 23:59:59",$dateTime);
            $map['classdate'] = array('between',array($dateStart,$dateEnd));
            $dateLessons = $this->where($map)->select();
            for ($i = 0; $i < count($dateLessons); $i++) {
                $timeValue = strtotime($dateLessons[$i]['classdate']);
                $dateLessons[$i]['clocktimeRange'] = array(($timeValue - 30*60),($timeValue + 60*60));
            }
            S ( $key, $dateLessons, 86400 );  // 86400 = 24 * 60 * 60
        }
        return $dateLessons;
    }
}