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
        'WxyCourseLesson'=>array('id', 'courseid', 'token', 'classdate', 'sequence', 'room', 'bat'),
        'WxyCourse'=>array('name'=>'name',
            'site' => 'site',
            'teacher' => 'teacher',
            'grade' => 'grade',
            '_on'=>'WxyCourseLesson.courseid = WxyCourse.id'),
    );
}