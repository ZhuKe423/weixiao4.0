<?php
/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2018/11/27
 * Time: 10:54
 */

namespace Addons\WeiXiao\Model;
use Think\Model\ViewModel;

class WxyStudentLessonViewModel extends ViewModel
{
    public $viewFields = array(
        'WxyStudentCourse' => array( 'token', 'courseid', 'bat_no', 'studentno', 'sid'),
        'WxyCourseLesson'=>array(
            'classdate' =>'classdate',
            'sequence' =>'sequence',
            'room' =>'room',
            'bat' =>'bat',
            '_on' =>'WxyStudentCourse.courseid = WxyCourseLesson.courseid AND WxyStudentCourse.bat_no = WxyCourseLesson.bat'
        ),
        'WxyCourse'=>array('name' => 'course_name',
            'site' => 'site',
            'teacher' => 'teacher',
            'grade' => 'grade',
            '_on'=>'WxyStudentCourse.courseid = WxyCourse.id'),
        'WxyStudentCard' => array('name' =>'student_name',
            'phone' => 'phone',
            'phone_bck' => 'phone_bck',
            '_on'=>'WxyStudentCourse.studentno = WxyStudentCard.studentno'
        )
    );
}