<?php
/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2018/11/19
 * Time: 15:46
 */

namespace Addons\WeiXiao\Model;
use Think\Model\ViewModel;

class WxyStudentCourseViewModel extends ViewModel
{
    public $viewFields = array(
        'WxyStudentCourse' => array( 'token', 'courseid', 'bat_no', 'studentno', 'sid'),
        'WxyCourseLesson'=>array(
            'classdate' =>'classdate',
            'sequence' =>'sequence',
            'room' =>'room',
            'bat' =>'bat',
            '_on' =>'WxyStudentCourse.courseid = WxyCourseLesson.courseid AND WxyStudentCourse.bat_no = WxyCourseLesson.bat AND WxyCourseLesson.sequence = 1'
            ),
        'WxyCourse'=>array('name' => 'course_name',
            'site' => 'site',
            'teacher' => 'teacher',
            'grade' => 'grade',
            '_on'=>'WxyStudentCourse.courseid = WxyCourse.id'),
        'WxyStudentCard' => array('name' =>'student_name',
            'phone' => 'phone',
            'phone' => 'phone_bck',
            '_on'=>'WxyStudentCourse.studentno = WxyStudentCard.studentno'
        )
    );
}