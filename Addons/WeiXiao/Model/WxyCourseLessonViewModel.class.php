<?php
/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2018/11/17
 * Time: 21:47
 */

namespace Addons\WeiXiao\Model;
use Think\Model\ViewModel;


class WxyCourseLessonViewModel extends ViewModel
{
    public $viewFields = array(
        'WxyCourseLesson'=>array('id' => 'lesson_id',
            'courseid', 'token', 'classdate', 'sequence', 'room', 'bat'),
        'WxyCourse'=>array('name'=>'course_name',
            'site' => 'site',
            'teacher' => 'teacher',
            'grade' => 'grade',
            'season' => 'season',
            '_on'=>'WxyCourseLesson.courseid = WxyCourse.id'),
    );
}