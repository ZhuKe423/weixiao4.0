<?php
/**
 * Created by PhpStorm.
 * User: Chen
 * Date: 2018/11/16
 * Time: 19:06
 */

namespace Addons\WeiXiao\Controller;
use Addons\WeiXiao\Controller\BaseController;

class CommentsController extends BaseController
{
    protected $model;
    protected $token;
    protected $school;
    protected $schooltype;
    protected $public_id;
    public function __construct() {
        if (_ACTION == 'show') {
            $GLOBALS ['is_wap'] = true;
        }

        parent::__construct ();
        $this->model = $this->getModel('WxyCourseComments'); //getModelByName ( $_REQUEST ['_controller'] );
        $this->token = get_token();
        $this->school = D('Common/Apps')->getInfoByToken($this->token, 'public_name');
        $this->schooltype = D('Common/Apps')->getInfoByToken($this->token, 'public_type');
        $this->public_id = D('Common/Apps')->getInfoByToken($this->token, 'id');
    }
    function _initialize()
    {
        parent::_initialize();
        $act = strtolower(ACTION_NAME);

        $res ['title'] = '评语列表';
        $res ['url'] = U('lists');
        $res ['class'] = $act == 'lists' ? 'current' : '';
        $nav [] = $res;

        $res ['title'] = '个别评语添加';
        $res ['url'] = U('add');
        $res ['class'] = $act == 'add' ? 'current' : '';
        $nav [] = $res;

        $res ['title'] = '评语导入';
        $res ['url'] = U('import');
        $res ['class'] = $act == 'import' ? 'current' : '';
        $nav [] = $res;
        $this->assign('nav', $nav);
    }

    public function import()
    {
        $id = I('id');
        $model = M('WxyCourse');

        if (IS_POST) {
            $data['file'] = I('post.file');
            $data['courseid'] = ltrim(strstr(I('post.course'), '.', true));
            $data['comment'] = I('post.comment');
            $data['token'] = $this->token;
            $sendflag = (I('post.msgsend') == "on") ? true : false;
            if (!intval($data['file'])) $this->error("数据文件未上传！");
            $import_model = M('wxy_course_commentsimport');
            $import_model->add($data);
            if ($this->import_comments_from_excel($data['file'], $data['courseid'], $data['classdate'], $sendflag)) //import student data from uploaded Excel file.
                $this->success('保存成功！', U('lists'/*'import?model=' . $this->model ['name'], $this->get_param */), 600);
            else
                $this->error('请检查文件格式');
        } else {
            if ($id) $map['id'] = $id;
            $map['token'] = $this->token;
            $data = $model->where($map)->select();
            $this->assign('lists', $data);
            $this->assign('id', $id);
            $this->display('import');
        }
    }

   private function import_comments_from_excel($file_id, $courseid = NULL, $classdate = NULL, $is_send = false)
    {
        if ($courseid == NULL) return false;
        $data = array();
        $column = array(
            'A' => 'studentno',
            /*
            'B' => 'uid',
            'C' => 'token',
            'D'=>'oid',
            */
            'B' => 'comments_txt',
            /*'C'=>'score2',
            'D'=>'score3',
            'E'=>'score',
            'F'=>'exmscore',
            'G'=>'comment'*/
        );
        $data = importFormExcel($file_id, $column);
        $score_model = D('WxyCourseComments');
        if ($data['status']) {
            foreach ($data['data'] as $row) {
                $row['token'] = $this->token;
                $row['courseid'] = $courseid;
                $score_model->addComments($row);
                $info = $score_model->verify($row);
                if ($is_send && ($info != false) && ($info != NULL)) {
                    $this->send_comment_msg($info);
                }
            }
            return true;
        } else return false;
    }

    private function send_comment_msg($info = NULL)
    {
        if ($info == NULL) return false;

        $map['id'] = intval($info['courseid']);
        $map['token'] = $info['token'];
        $model = M('WxyCourse');
        $course_data = $model->where($map)->find();

        if ($course_data == NULL) return false;
        $data['course'] = $course_data['name'];
        $data['teacher'] = $course_data['teacher'];
        $data['token'] = $info['token'];
        $data['stuname'] = $info['name'];
        $data['comment'] = $info['comments_txt'];
        $data['date'] = $info['timestamp'];

        $map1['studentno'] = $info['studentno'];
        $map1['token'] = $info['token'];
        $care_data = M('WxyStudentCare')->where($map1)->select();

        if ($care_data == NULL) return false;

        foreach ($care_data as $item) {
            $url = '';
            D('WxyScore')->send_course_comment_to_user($item['openid'], $url, $data, $info['token']);
        }


        return true;
    }

    private function import_data_from_excel($file_id, $courseid = NULL, $classdate = NULL)
    { //增加起始日期和课程长度参数！
        if ($courseid == NULL) return false;
        $data = array();
        $column = array(
            'A' => 'studentno',
            'B' => 'score1',
            'C' => 'score2',
            'D' => 'score3',
            'E' => 'score',
            'F' => 'exmscore',
            'G' => 'comment'
        );
        $data = importFormExcel($file_id, $column);
        $score_model = D('WxyScore');
        if ($data['status']) {
            foreach ($data['data'] as $row) {
                $row['token'] = $this->token;
                $row['courseid'] = $courseid;
                $row['classdate'] = $classdate;
                $score_model->addScore($row);
            }
            return true;
        } else return false;
    }


}