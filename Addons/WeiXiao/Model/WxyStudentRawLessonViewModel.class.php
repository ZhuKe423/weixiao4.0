<?php
/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2018/11/28
 * Time: 23:19
 */

namespace Addons\WeiXiao\Model;
use Think\Model\ViewModel;

class WxyStudentRawLessonViewModel extends ViewModel
{
    public $viewFields = array(
        'WxyStudentLesson' => array( 'token', 'courseid', 'lesson_id', 'studentno', 'sid', 'bat', 'status'),
        'WxyCourse'=>array('name' => 'course_name',
            'site' => 'site',
            'teacher' => 'teacher',
            'grade' => 'grade',
            '_on'=>'WxyStudentLesson.courseid = WxyCourse.id'),
        'WxyCourseLesson'=>array(
            'classdate' =>'classdate',
            'sequence' =>'sequence',
            'room' => 'room',
            'bat' => 'bat',
            'id' => 'lesson_id',
            '_on' =>'WxyStudentLesson.lesson_id = WxyCourseLesson.id'
        ),
        'WxyStudentCard' => array('name' =>'student_name',
            'phone' => 'phone',
            'phone_bck' => 'phone_bck',
            '_on'=>'WxyStudentLesson.studentno = WxyStudentCard.studentno'
        )
    );
}