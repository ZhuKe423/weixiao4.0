<?php
/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2017/2/21
 * Time: 10:46
 */
namespace Addons\WeiXiao\Model;
//use Think\Model;
use Think\Model\ViewModel;

class WxyStudentCommentsViewModel extends ViewModel {
    public $viewFields = array(
        'WxyStudentCare'=>array('token', 'sid', 'studentno', 'uid', 'openid', 'is_audit'),
        'WxyStudentCard'=>array('name'=>'student_name',
            'gender' => 'gender',
            'school' => 'school',
            'grade'  => 'grade',
            'phone'  => 'phone',
            '_on'=>'WxyStudentCare.sid = WxyStudentCard.id'), // To see changed to WxyStudentCard.id

        'WxyCourseComments' => array(
            'courseid' => 'courseid',
            'comment_txt' => 'comments_txt',
            'comment_voice' => 'comments_voice',
            'timestamp' => 'timestamp',
            'lesson_id',
            '_on' => 'WxyStudentCard.id = WxyCourseComments.sid AND WxyStudentCard.token = WxyCourseComments.token'
        ),

        'WxyCourse' => array (
            'site' => 'site',
            'name' => 'course_name',
            'teacher' => 'teacher',
            'sdate' => 'classdate',
            '_on' => 'WxyCourseComments.courseid = WxyCourse.id'
        ),
    );
}