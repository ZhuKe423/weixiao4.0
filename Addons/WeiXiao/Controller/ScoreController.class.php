<?php

namespace Addons\WeiXiao\Controller;
use Addons\WeiXiao\Controller\BaseController;

class ScoreController extends BaseController{

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
        $this->config = getAddonConfig ( 'WeiXiao' );
    }

    function _initialize()
    {
        parent::_initialize();
        $act = strtolower(ACTION_NAME);

        $res ['title'] = '学生成绩列表';
        $res ['url'] = U('lists');
        $res ['class'] = $act == 'lists' ? 'current' : '';
        $nav [] = $res;

        $res ['title'] = '个别成绩添加';
        $res ['url'] = U('add');
        $res ['class'] = $act == 'add' ? 'current' : '';
        $nav [] = $res;

        $res ['title'] = '成绩导入';
        $res ['url'] = U('import');
        $res ['class'] = $act == 'import' ? 'current' : '';
        $nav [] = $res;
        $this->assign('nav', $nav);
    }

    public function get_lesson() {
        if (IS_POST ||IS_AJAX) {
            $map["courseid"] = I("course_id");
            $map["token"] = $this->token;
            $model = D("WxyCourseLessonView");
            $data = $model->where($map)->select();
            //$json_data = json_encode($data);
            $this->ajaxReturn($data);
        }
    }

    /**
     * 显示指定模型列表数据
     */
    public function lists()
    {
        $page = I('p', 1, 'intval'); // 默认显示第一页数据
        // 解析列表规则
        $list_data = $this->_get_model_list($this->model);//_list_grid($this->model);
        $grids = $list_data ['list_grids'];
        $fields = $list_data ['fields'];
        $map ['token'] = get_token();

        // 关键字搜索
        $key = $this->model ['search_key'] ? $this->model ['search_key'] : 'title';

        if (isset ($_REQUEST [$key])) {
            $map [$key] = array(
                'like',
                '%' . htmlspecialchars($_REQUEST [$key]) . '%'
            );
            unset ($_REQUEST [$key]);
        }
        // 条件搜索
        //$date_range = array();
        foreach ($_REQUEST as $name => $val) {
            if (in_array($name, $fields)) {
                $map [$name] = $val;
            }

            if($name == 'start_time' && $val !="")
            {
                ($map['classdate'] == NULL)?$map['classdate']= array(array('gt',$val)):array_push($map['classdate'],array('egt',$val));
            }
            if($name == 'end_time' && $val !="")
            {
                ($map['classdate'] == NULL)?$map['classdate']= array(array('lt',$val)):array_push($map['classdate'],array('elt',$val));
            }
        }
        $row = empty ($this->model ['list_row']) ? 20 : $this->model ['list_row'];

        // 读取模型数据列表
        //var_dump($map);
        empty ($fields) || in_array('id', $fields) || array_push($fields, 'id');
        $name = parse_name(get_table_name($this->model ['id']), true);
        //var_dump($name);
        //exit();
        $data = M($name)->field(empty ($fields) ? true : $fields)->where($map)->order('id')->page($page, $row)->select();

        /* 查询记录总数 */
        $count = M($name)->where($map)->count();

        //var_dump($list_data);
        //var_dump($data);
        //var_dump($count);
        //var_dump($grids);
        //var_dump($this->model);
        //exit();
        // 分页
        if ($count > $row) {
            $page = new \Think\Page ($count, $row);
            $page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
            $this->assign('_page', $page->show());
        }
        $this->assign('list_grids', $grids);
        $this->assign('list_data', $data);
        $this->assign('search_button',false);

        $key_datetime = array("type"=>"datetime","title"=>"有效时间","start_time"=>"","end_time"=>date("Y-m-d"));
        //$key_datetime = array("type"=>"datetime","title"=>"有效时间");
        //$key_course = array("type"=>"select","title"=>"科目","name"=>"subject","options"=>array(array("value"=>1,"name"=>"语文","title"=>"语文"),array("value"=>2,"name"=>"数学","title"=>"数学")));
        //$key_course = array("type"=>"input","title"=>"科目","name"=>"subject");
        $key_studentno = array("type"=>"input","title"=>"学号","name"=>"studentno");
        $muti_keys = array($key_datetime, $key_studentno,NULL);
        $this->assign('muti_search',$muti_keys);
        $this->assign('search_key',array('classdate','studentno'));
        $this->meta_title = $this->model ['title'] . '列表';

        $this->display('lists');
    }

    // Send a Weixin template message to use to notify the score:

    public function send()
    {
        $score_id = I('id');
        $map['id'] = $score_id;
        $model = D('WxyScoreNotifyView');
        $score_data = $model->where($map)->select();
        /*var_dump($model->getLastSql());
        var_dump($score_data);
        */
        $statue = 0;
        foreach ($score_data as $value) {
            $url = U('addon/Student/Wap/score', array('publicid'=>$this->public_id, 'studentno' => $value['studentno']));
            //var_dump($value);
            $retdata = D('WxyScore')->send_score_to_user($value['openid'], $url, $value, $this->token, $this->school);

            $statue += ($retdata["errcode"] == 0)?0:1;
            usleep(60000);
        };

        if($statue == 0) {
            $this->success("此次成绩通知单已经发送到关注该学生的微信号上！");

            $data = M('WxyScore')->where($map)->select()[0];
            $data["weixinmsgsend"] = "已发送";
            //var_dump($data);
            M('WxyScore')->where($map)->save($data);
        }
        else
            $this->error("成绩通知单发送错误！");
    }

    public function import()
    {
        $uid = $this->uid;
        $token = $this->token;
        $id = I('id');
        $model = M('WxyCourse');

        if ($uid == 0) redirect(U('Common/Apps'));
        if (IS_POST) {
            $data['file'] = I('post.file');
            $data['courseid'] = ltrim(strstr(I('post.course'), '.', true));
            $data['classdate'] = I('post.classdate');
            $data['comment'] = I('post.comment');
            $data['token'] = $this->token;
            /*$data['token'] = $token;
            $course_obj = explode('.',I('post.courseid'));
            $data['teacher'] = $course_obj[2];
            $data['courseid'] = $course_obj[0];
            $data['term'] = I('post.term');
            $data['file'] = I('post.file');
            $data['classdate'] = I('post.classdate');
            $data['comment'] = I('post.comment');*/

//            $sendflag = (I('post.msgsend') == "on")?true:false ;

            if (!intval($data['file'])) $this->error("数据文件未上传！");
            $import_model = D('WxyScoreimport');
            $res = $import_model->addImport($data);
            /*$data['termid'] = $res;
            $data['subject'] = $course_obj[1];*/

            if ($this->import_course_lesson_from_excel($data['file'])) {
                // $this->success('保存成功！', U('lists'/*'import?model=' . $this->model ['name'], $this->get_param */), 600);
            }
            else
                $this->error('请检查文件格式');
        } else {
            if ($id) $map['id'] = $id;
            $map['token'] = $this->token;
            $data = $model->where($map)->select();
            $this->assign('lists', $data);
            $this->assign('id', $id);
            $this->display('import');

            /*$this->assign('public_id', $this->public_id);
            $this->assign('course_valid_date',date('Y-m-d',strtotime('-1 year')));
            $this->display('import');*/
        }
    }

    //This function was modified for full time school under Weixiao addon.
    private function import_student_score_from_excel($file_id, $base_data, $sendflag)
    {
        $data = array();
        $column = array(
            'A' => 'studentno',  //学生编号
            'B' => 'score1',     //课堂表现
            'C' => 'score2',     //出勤情况
            'D' => 'score3',      //作业完成
            'E' => 'score',       //总分
            'F' => 'exmscore',    //测试分数
            'G' => 'comment'
        );
        $data = importFormExcel($file_id, $column);
        $score_model = D('WxyScore');
        if ($data['status']) {
            foreach ($data['data'] as $row) {
                $row['token'] = $this->token;
                //$row['termid']= $base_data['termid'];
                $row['classdate'] = $base_data['classdate'];
                $row['courseid'] = $base_data['courseid'];
                //$row['subject'] = $base_data['subject'];
                //$row['term'] = $base_data['term'];
                //$row['score'] = '';
                $map['token'] = $this->token;
                $map['studentno'] = $row['studentno'];
                $stu_arry = M('WxyStudentCard')->where($map)->select();

                if (count($stu_arry) != 0) $row['name'] = $stu_arry[0]['name'];
                //var_dump($map,$stu_arry,$stu_arry[0]['name'],count($stu_arry),$row);
                $row['weixinmsgsend'] = $sendflag ? "已发送" : "未发送";
                $it = $score_model->addScore($row);
                if ($sendflag) {
                    //var_dump($it);
                    $this->wx_send_msg($it);
                }

            }
            return true;
        } else return false;
    }
}
