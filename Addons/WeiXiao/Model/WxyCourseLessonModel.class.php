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

}