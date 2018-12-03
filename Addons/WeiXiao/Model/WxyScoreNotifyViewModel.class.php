<?php
/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2016/11/27
 * Time: 15:08
 */
namespace Addons\WeiXiao\Model;
use Think\Model\ViewModel;


class WxyScoreNotifyViewModel extends ViewModel {
    public $viewFields = array(

        'WxyScore' => array(
            'token'     => 'token',
            'id'        => 'id', 
            'sid'       => 'sid', 
            'courseid'  => 'courseid', 
            //'term'      => 'exam',
            'score'     => 'score', 
            'score1'    => 'score1', 
            'score2'    => 'score2', 
            'score3'    => 'score3', 
            //'exmscore'  => 'exmscore',
            'classdate' =>  'classdate', 
            'comment'   =>  'comment',
            'lesson_id' => 'lesson_id',
            'studentno' => 'studentno'

        ),

        'WxyStudentCare'=>array(
            'token'     => 'token',
            'openid' => 'openid',
            'studentno' => 'studentno',
            '_on' => 'WxyScore.studentno = WxyStudentCare.studentno AND WxyScore.token  = WxyStudentCare.token',
            //'_type'=>'LEFT'
            //'_on'    => 'WxyScore.token = WxyStudentCare.token AND WxyScore.studentno = WxyStudentCare.studentno'
        ),

        'WxyStudentCard'=>array(
            'name' =>'student_name',
            'name' => 'stuname',
            '_on'=>'WxyStudentCare.studentno = WxyStudentCard.studentno'
        ), // To see changed to WxyStudentCard.id

        'WxyCourse' => array (
            'name' => 'course',
            'teacher' => 'teacher',
            'grade' => 'grade',
            'site' => 'site',
            '_on' => 'WxyScore.courseid = WxyCourse.id'
        ),
        /*
        'WxyDailyTime' => array(
            'arriveTime' => 'arriveTime',
            'leaveTime' => 'leaveTime',
            'state' => 'state',
            'description' => 'description',
            '_on' => 'WxyStudentCard.studentno = WxyDailyTime.studentID'
        )
        */

    );
}