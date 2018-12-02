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
        $this->model = $this->getModel('WxyCourseScore'); //getModelByName ( $_REQUEST ['_controller'] );
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
            $data = $model->where($map)->order('bat asc, sequence asc')->select();
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
            $retdata = D('WxyCourseScore')->send_score_to_user($value['openid'], $url, $value, $this->token, $this->school);

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

            $data['token'] = $token;
            $data['uid'] = $uid;
            $data['file'] = I('post.file_id');
            $data['courseid'] = I('post.course');
            (I('post.bind_lesson') == 'on') ?  $data['lesson_id'] = I('post.lesson_id') : $data['lesson_id'] = 0;
            //$data['sdate'] = I('post.sdate');
            //$data['length'] = I('post.length');
            $data['comment'] = I('post.comment');
            $data['model_id'] = $this->model['id'];
            $data['model_name'] = $this->model['name'];

            $sendflag = (I('post.msgsend') == "on") ? true : false;
            if (!intval($data['file'])) $this->error("数据文件未上传！");
            $import_model = M('WxyModelImport');
            $import_model->add($data);

            $map['token'] = $this->token;
            $map['courseid'] = $data['courseid'];
            $data['lesson_id'] == 0 || $map['lesson_id'] = $data['lesson_id'];
            $lesson_data = D('WxyCourseLessonView')->where($map)->find();
            if (empty($lesson_data))
                $this->error('请选择课程和课时！');

            if ($this->import_student_score_from_excel($data['file'], $lesson_data, $sendflag)) {
                // $this->success('保存成功！', U('lists'/*'import?model=' . $this->model ['name'], $this->get_param */), 600);
            }
            else
                $this->error('请检查文件格式');
        } else {
            if ($id) $map['id'] = $id;
            $map['token'] = $this->token;
            $map['status'] = array('lt',3); //上架或即将上架课程
            $data = $model->where($map)->order('season desc, grade asc')->select();
            $this->assign('lists', $data);
            $this->assign('id', $id);
            $this->display('import');
        }
    }

    //This function was modified for full time school under Weixiao addon.
    private function import_student_score_from_excel($file_id, $base_data, $sendflag)
    {
        $data = array();
        $column = array(
            'A' => 'studentno',  //学生编号
            'B' => 'name',
            'C' => 'score1',     //课堂表现
            'D' => 'score2',     //出勤情况
            'E' => 'score3',      //作业完成
            'F' => 'score',       //总分
            'G' => 'comment'
        );
        $data = importFormExcel($file_id, $column, null , 3);
        $score_model = D('WxyCourseScore');
        if ($data['status']) {
            foreach ($data['data'] as $row) {
                $row['token'] = $this->token;
                //$row['termid']= $base_data['termid'];
                $row['classdate'] = $base_data['classdate'];
                $row['courseid'] = $base_data['courseid'];
                ($base_data['lesson_id'] == 0) || $row['lesson_id'] = $base_data['lesson_id'];

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

    private function wx_send_msg($score_id){
        $map['id'] = $score_id;
        $score_data = D('WxyScoreNotifyView')->where($map)->select();
        //var_dump($score_data);

        foreach ($score_data as $value) {
            $url = U('addon/Student/Wap/score', array('publicid'=>$this->public_id, 'studentno' => $value['studentno']));
            //var_dump($value);
            $retdata = D('WxyCourseScore')->send_score_to_user($value['openid'], $url, $value, $this->token, $this->school);
            if($retdata["errcode"] == 0)
                usleep(30000);
            else
                usleep(1000);
        };

    }

    function post($url, $param=array()){
        if(!is_array($param)){
            throw new Exception("参数必须为array");
        }
        $httph =curl_init($url);
        curl_setopt($httph, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($httph, CURLOPT_SSL_VERIFYHOST, 1);
        curl_setopt($httph,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($httph, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)");
        curl_setopt($httph, CURLOPT_POST, 1);//设置为POST方式
        curl_setopt($httph, CURLOPT_POSTFIELDS, $param);
        curl_setopt($httph, CURLOPT_RETURNTRANSFER,1);
        curl_setopt($httph, CURLOPT_HEADER,1);
        $rst=curl_exec($httph);
        curl_close($httph);

        return $rst;
    }
}
