<?php
/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2018/10/11
 * Time: 14:43
 */

namespace Addons\WeiXiao\Controller;

use Think\ManageBaseController;

class CourseController extends ManageBaseController
{
    protected $model;
    protected $token;
    protected $school;
    protected $schooltype;
    protected $config;

    public function __construct()
    {
        if (_ACTION == 'show') {
            $GLOBALS ['is_wap'] = true;
        }

        parent::__construct();
        $this->model = $this->getModel('WxyCourse'); //getModelByName ( $_REQUEST ['_controller'] );

        $this->token = get_token();
        $this->school = D('Common/Apps')->getInfoByToken($this->token, 'public_name');
        $this->schooltype = D('Common/Apps')->getInfoByToken($this->token, 'public_type');
        $this->config = getAddonConfig ( 'WeiXiao' );

        $this->assign('model', $this->model);
    }
    function _initialize()
    {
        parent::_initialize();
        $act = strtolower(ACTION_NAME);

        $res ['title'] = '课程列表';
        $res ['url'] = U('lists');
        $res ['class'] = $act == 'lists' ? 'current' : '';
        $nav [] = $res;

        $res ['title'] = '课程新增';
        $res ['url'] = U('add');
        $res ['class'] = $act == 'add' ? 'current' : '';
        $nav [] = $res;

        $res ['title'] = '排课列表';
        $res ['url'] = U('lessonList');
        $res ['class'] = $act == 'lessonList' ? 'current' : '';
        $nav [] = $res;

        $res ['title'] = '排课导入';
        $res ['url'] = U('import');
        $res ['class'] = $act == 'import' ? 'current' : '';
        $nav [] = $res;
        $this->assign('nav', $nav);
    }

    /**
     * 显示指定模型列表数据
     */
    private function addLesson($cid, $lessonMoel){
        $courseDao = D('WxyCourse');
        $map['id'] = $cid;
        $coursedata = $courseDao->where($map)->find();
        $mLesson['courseid'] = $cid;
        $mLesson['classlen'] = '110';
        $mLesson['site'] = $coursedata['site'];
        $length = $coursedata['length'];
        for($seq = 1; $seq <= $length; $seq++){
            $mLesson['sequence'] = $seq;
            $mLesson['classdate'] = date('y-m-d',strtotime('+'.strval( 7*($seq-1)).'days',$coursedata['sdate']));;
            $lessonMoel->addCourseLesson($mLesson);
        }
    }
    public function lessonList()
    {
        session('g_lesson_url', $_SERVER["REQUEST_URI"]);

        $seach_key = '';
        ((I('cid') == '') || (I('cid') == null)) || $seach_key = I('cid');
        $lessonDao = D('WxyCourseLesson');

        $map['courseid'] = $seach_key;
        $searchLesson = $lessonDao->where($map)->find();
        if(empty($searchLesson)){
            $this->addLesson($seach_key, $lessonDao);
        }
        $lessonModel = $this->getModel('WxyCourseLesson');
        $courseModel = $this->getModel('WxyCourse');
//        $list_data = $this->_get_model_list($lessonModel);//_list_grid($this->model);
//        dump($list_data);
        $list_lesson_grid_data = $this->_list_grid ( $lessonModel );
        $list_course_grid_data = $this->_list_grid ( $courseModel );

        $gridsLesson = $list_lesson_grid_data ['list_grids'];

        $gridsCourse = $list_course_grid_data ['list_grids'];
        $grids =array();
        $grids['classdate'] = $gridsLesson['classdate'];
        $grids['classlen'] = $gridsLesson['classlen'];
        $grids['name'] = $gridsCourse['name'];
        $grids['teacher'] = $gridsCourse['teacher'];
        $grids['grade'] = $gridsCourse['grade'];
        $grids['room'] = $gridsLesson['room'];
        $grids['site'] = $gridsLesson['site'];
        $grids['sequence'] = $gridsLesson['sequence'];
        $grids['urls'] = $gridsLesson['urls'];

//dump($grids['urls']);

        $db_prefix = C ( 'DB_PREFIX' );

        $page = I ( 'p', 1, 'intval' );
        $row = empty ($lessonModel) ? 20 : $lessonModel ['list_row'];
        $map ['token'] = get_token();
        if (!empty($seach_key))
        {
            $list_data = $lessonDao->table($db_prefix.'wxy_course_lesson cols, '.$db_prefix.'wxy_course co')->where('cols.courseid = co.id' . ' and cols.courseid = ' . $seach_key)->field('cols.id as id, cols.classdate as classdate, cols.classlen as classlen, co.name as name, co.teacher as teacher, co.grade as grade, cols.room as room, cols.site as site, cols.sequence as sequence')->order('cols.id asc')->page ( $page, $row )->select();
            $count = $lessonDao->table($db_prefix.'wxy_course_lesson cols, '.$db_prefix.'wxy_course co')->where('cols.courseid = co.id' . ' and cols.courseid = ' . $seach_key)->count();

        }
        else{
            $list_data = $lessonDao->table($db_prefix.'wxy_course_lesson cols, '.$db_prefix.'wxy_course co')->where('cols.courseid = co.id')->field('cols.id as id, cols.classdate as classdate, cols.classlen as classlen, co.name as name, co.teacher as teacher, co.grade as grade, cols.room as room, cols.site as site, cols.sequence as sequence')->order('cols.id asc')->page ( $page, $row )->select();
            $count = $lessonDao->table($db_prefix.'wxy_course_lesson cols, '.$db_prefix.'wxy_course co')->where('cols.courseid = co.id')->count();

        }
        if ($count > $row) {
            $page = new \Think\Page ($count, $row);
            $page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
            $this->assign('_page', $page->show());
        }
        foreach($list_data as &$row){
            $row['grade']= $this->config['grade_value'][$row['grade']];
         }
        $dataTable = D ( 'Common/Model' )->getFileInfo ( $lessonModel );
//        dump($dataTable);
        $list_data = $this->parseData ( $list_data, $dataTable->fields, $dataTable->list_grid, $dataTable->config );
        $this->assign('list_grids', $grids);
        $this->assign('list_data', $list_data);
        $this->assign('search_key', 'name');
        $this->meta_title = $this->model ['title'] . '列表1';

        $this->display('lists');
    }

    public function lists()
    {
        parent::common_lists($this->model);
    }

    public function add()
    {
        //var_dump($this);
        if (IS_POST) {
            $data['name'] = I('post.name');
            $data['teacher'] = I('post.teacher');
            $data['intro'] = I('post.intro');
            $data['cover'] = intval(I('post.cover'));
            $data['token'] = $this->token;
            $data['sdate'] = I('post.sdate');
            $data['edate'] = I('post.edate');
            $data['length'] = I('post.length');
            $data['timestamp'] = date('Y-m-d H:i:s');
            //var_dump($data['timestamp']);
            $id = I('post.id');
            //$map['cover'] = $data['cover'];
            $model = M('WxyCourse');
            if (!intval($id)) {
                $map['name'] = array('like', $data['name']);
                if ($model->where($map)->select())
                    $this->error("该课程已经录入");
                else {
                    M('WxyCourse')->add($data);
                    $this->success("课程内容录入成功");
                }
            } else {
                $map['id'] = I('post.id');
                $model->where($map)->save($data);
                $this->success("课程内容更新成功");
            }
        } else {
            //$data['teacher'] = '任老师';
            //$data['sdate'] = '2017-01-12';
            //$this->assign('data', $data);

            parent::common_add($this->model);
            /*$this->assign('id', '0');
            $this->display();*/
        }
    }

    function set_top() {
        $cid = I('cid');
        $map['token'] = $this->token;
        $map['id'] = $cid;

        $data['top'] = '1'; //精品课程
        $course = M('wxy_course');

        //dump($course->where($map)->select());
        $count = $course->where($map)->save($data);
        if ($count) $this->success("更新成功，已设置此课为精品！");
        else $this->error("未更新数据！");
    }
    public function lesson_edit($model = null, $id = 0, $templateFile = '') {
        is_array ( $model ) || $model = $this->getModel ( $model );
        $id || $id = I ( 'id' );

        // 获取数据
        $data = M ( get_table_name ( $model ['id'] ) )->find ( $id );
        $data || $this->error ( '100004:数据不存在！' );

        $token = get_token ();
        if (isset ( $data ['token'] ) && $token != $data ['token'] && defined ( 'ADDON_PUBLIC_PATH' )) {
            $this->error ( '100005:非法访问！' );
        }

        if (IS_POST) {
            $Model = D ( parse_name ( get_table_name ( $model ['id'] ), 1 ) );
            // 获取模型的字段信息
            $Model = $this->checkAttr ( $Model, $model ['id'] );
            if ($Model->create () && false !== $Model->save ()) {
                $this->_saveKeyword ( $model, $id );

                // 清空缓存
                method_exists ( $Model, 'clear' ) && $Model->clear ( $id, 'edit' );

               $this->success ( '保存' . $model ['title'] . '成功！',$_SERVER["HTTP_ORIGIN"].session('g_lesson_url'));
            } else {
                $this->error ( '100006:' . $Model->getError () );
            }
        } else {

            $fields = get_model_attribute ( $model ['id'] );
            $this->assign ( 'fields', $fields );
            $this->assign ( 'data', $data );

            $this->display ( $templateFile );
        }
    }
    public function edit()
    {
        if((I('model') == 'wxy_course_lesson')||(!empty(I('courseid')))){
            $model = $this->getModel('WxyCourseLesson');
            $this->lesson_edit($model);
        }
        else{
            parent::common_edit($this->model);
        }

    }

    public function import()
    {
        $uid = $this->uid;
        $token = $this->token;
        $id = I('id');
        $model = M('WxyCourse');

        if (IS_POST) {
//            $data['file'] = I('post.file');
//            $data['courseid'] = ltrim(strstr(I('post.course'), '.', true));
//            $data['classdate'] = I('post.classdate');
//            $data['comment'] = I('post.comment');
//            $data['token'] = $this->token;

            $data['uid'] = $uid;
            $data['token'] = $token;
            $data['file'] = I('post.file_id');
            $data['sdate'] = I('post.sdate');
            $data['length'] = I('post.length');
            $data['comment'] = I('post.comment');
            $data['model_id'] = $this->model['id'];
            $data['model_name'] = $this->model['name'];
            $data['title'] = I('post.title');
            $site = I('post.site');

//            if (!intval($data['file'])) $this->error("数据文件未上传！");
            $import_model = M('WxyModelImport');
            $import_model->add($data);
            /*$data['termid'] = $res;
            $data['subject'] = $course_obj[1];*/

            if ($this->import_course_lesson_from_excel($data['file'], $data['sdate'], $data['length'], $site)) //import student data from uploaded Excel file.
                $this->success('保存成功！', U('lists'/*'import?model=' . $this->model ['name'], $this->get_param */), 600);
            else
                $this->error('请检查文件格式');
        } else {
            if ($id) $map['id'] = $id;
            $map['token'] = $this->token;
            $data = $model->where($map)->select();
            $this->assign('data', $data[0]);
            $this->assign('id', $id);
            $this->display();

            /*$this->assign('public_id', $this->public_id);
            $this->assign('course_valid_date',date('Y-m-d',strtotime('-1 year')));
            $this->display('import');*/
        }
    }

    public function scoreimport()
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

    /**
     * @param $file_id
     * @param $sdate
     * @param $length
     * @param $site
     */
    private function import_course_lesson_from_excel($file_id, $sdate, $length, $site)
    {
        $data = array();
        $row = array(
            '2' => 'day',
            '3' => 'grade',    //年级
            '4' => 'course_1',   //课程
            '5' => 'teacher_1',  //教师
            '6' => 'subject_1',  //科目
            '7' => 'room_1',     //教室
            '8' => 'course_2',   //课程
            '9' => 'teacher_2',  //教师
            '10' => 'subject_2',  //科目
            '11' => 'room_2',     //教室
            '12' => 'course_3',   //课程
            '13' => 'teacher_3',  //教师
            '14' => 'subject_3',  //科目
            '15' => 'room_3',     //教室
            '16' => 'course_4',   //课程
            '17' => 'teacher_4',  //教师
            '18' => 'subject_4',  //科目
            '19' => 'room_4',     //教室
            '20' => 'course_5',   //课程
            '21' => 'teacher_5',  //教师
            '22' => 'subject_5',  //科目
            '23' => 'room_5',     //教室
        );
        $data0 = importFormExcel_Column($file_id, $row, array(), 'A'); //read excel file from start_column!
        $grade = '';
        $day = '';
        $excel_data = $data0['data'];
        unset($data0);

        foreach ($excel_data as $key => $vo) {
            if ($vo['grade'] != '') {
                $grade = $vo['grade'];
            } else {
                $excel_data[$key]['grade'] = $grade;
            }
            if ($vo['day'] != '') {
                $day = $vo['day'];
            } else {
                $excel_data[$key]['day'] = $day;
            }
        }
        $course_model = D('WxyCourse');
        $course_lesson_model = D('WxyCourseLesson');
        $schedule = array();
        $course_data = array();
        $lesson_data = array();

        $lesson_data_raw_list = array();
        //处理课程，导入数据库，已经调试OK！
        foreach ($excel_data as $key => $vo) {
            if (strpos($vo['grade'], '年级') !== false) {
                $schedule = $vo;
            } else {
                $day = trim($vo['day'],'[]');
                $mDays = explode(',', $day);
                $course_data['grade'] = strval(array_search($vo['grade'], $this->config['grade_value']));
                $course_data['token'] = $this->token;
                $course_data['site'] = $site;
                $course_data['length'] = count($mDays);
                $course_data['sdate'] = strtotime(current($mDays));
                $course_data['edate'] = strtotime(end($mDays));
                $lesson_data['grade'] = strval(array_search($vo['grade'], $this->config['grade_value'])); //$vo['grade'];
                $lesson_data['site'] = $site;
                $lesson_data['token'] = $this->token;
                $lesson_data['day'] = $mDays;

                for ($i = 1; $i <= 5; $i++) {
                    $start_end = explode('--', $schedule['course_' . $i]);
                    $course_data['name'] = $vo['course_' . $i];
                    $course_data['teacher'] = $vo['teacher_' . $i];
                    $course_id = $course_model->addCourse($course_data);
                    $lesson_data['courseid_' . $i] = $course_id;

                    $lesson_data['room_' . $i] = $vo['room_' . $i];
                    $lesson_data['start_time_' . $i] = $start_end[0];
                }
                $lesson_data_raw_list[] = ($lesson_data);
            }
        }

        //处理课表，导入数据库
        foreach ($lesson_data_raw_list as $lesson) {
            for ($i = 1; $i <= 5; $i++) {
                if (!isset($lesson['courseid_' . $i]))
                    continue;
                $mLesson['token'] = $lesson['token'];
                $mLesson['courseid'] = $lesson['courseid_' . $i];
                $mLesson['classlen'] = '110';
                $mLesson['site'] = $site;
                $mLesson['room'] = $lesson['room_' . $i];
                $mLesson['sequence'] = 1;
                foreach ($lesson['day'] as $sDay) {
                    $dstime = date('y-m-d h:i:s', strtotime($sDay . " " . $lesson['start_time_' . $i]));
                    $mLesson['classdate'] = $dstime;
                    $course_lesson_model->addCourseLesson($mLesson);
                    $mLesson['sequence']++;
                }
            }
        }
        return true;
    }

    public function comment()
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
            $this->display('commentimport');
        }
    }

    public function notify()
    {
        $id = I('id');
        $model = M('WxyCourse');

        if (IS_POST) {
            $sendflag = (I('post.msgsend') == "on") ? true : false;
            $allflag = (I('post.allfollower') == "on") ? true : false;
            $info['first_data'] = '本消息反映学校动态，敬请关注。';
            $course = I('post.course');
            $info['keyword1_data'] = substr($course, strpos($course, '. ') + 2);
            $info['remark_data'] = I('post.comment');
            $base_url = 'http://www.jzk12.com/weiphp30/index.php?s=/addon/WeiSite/WeiSite/detail/id/';
            if (strlen(I('post.msgurl')) < 9) {
                $article_id = intval(I('post.msgurl'));
                if ($article_id == 0) $url = '';
                else
                    $url = $base_url . strval($article_id);
            } else {
                $url = I('post.msgurl');
            }
            /*dump ($url);*/
            if ($info['remark_data'] == '') {
                $map['id'] = $article_id;
                $map['token'] = $this->token;
                $data = M('custom_reply_news')->where($map)->find();
                $map['id'] = $data['cate_id'];
                $cate_data = M('weisite_category')->where($map)->find();
                $cate_data = ($cate_data == null) ? '' : '【' . $cate_data['title'] . '】';
                $info['remark_data'] = $cate_data . $data['title'] . '，点击查看详情：';
            }
            if ($allflag && $sendflag) {
                if ($url == '')
                    $this->error('文章链接不存在，不能群发此消息！');
                else {
                    $info['keyword1_data'] = '所有课程';
                    $info['keyword2_data'] = '全体';
                    $map1['token'] = $this->token;
                    $map1['has_subscribe'] = 1;
                    //$map1['uid'] = 348;
                    $user_list = M('public_follow')->where($map1)->select();
                    foreach ($user_list as $user) {
                        $resstr = D('WxyCourse')->send_course_notification_to_user($user['openid'], $url, $info, $this->token);
                        //dump($resstr);
                    }

                    $this->success('消息群发成功！');
                }
            }
        } else {
            if ($id) $map['id'] = $id;
            $map['token'] = $this->token;
            $data = $model->where($map)->select();
            $this->assign('lists', $data);
            $this->assign('id', $id);
            $this->display('coursenotify');
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


    private function dateDiff($date_1, $date_2, $differenceFormat = '%a')
    {
        $datetime1 = date_create($date_1);
        $datetime2 = date_create($date_2);
        $interval = date_diff($datetime1, $datetime2);
        return $interval->format($differenceFormat);
    }

    // Send a Weixin template message to use to notify the score:

    public function send()
    {
        $score_id = I('id');
        $map['id'] = $score_id;
        $score_data = D('WxyScoreNotifyView')->where($map)->select();
        //var_dump($score_data);
        $statue = 0;
        foreach ($score_data as $value) {
            $url = U('addon/Student/Wap/score', array('publicid' => $this->public_id, 'studentno' => $value['studentno']));
            //var_dump($value);
            $retdata = D('WxyScore')->send_score_to_user($value['openid'], $url, $value, $this->token, $this->school);

            $statue += ($retdata["errcode"] == 0) ? 0 : 1;
            usleep(60000);
        };

        if ($statue == 0) {
            $this->success("此次成绩通知单已经发送到关注该学生的微信号上！");

            $data = M('WxyScore')->where($map)->select()[0];
            $data["weixinmsgsend"] = "已发送";
            //var_dump($data);
            M('WxyScore')->where($map)->save($data);
        } else
            $this->error("成绩通知单发送错误！");
    }

    private function wx_send_msg($score_id)
    {
        $map['id'] = $score_id;
        $score_data = D('WxyScoreNotifyView')->where($map)->select();
        //var_dump($score_data);

        foreach ($score_data as $value) {
            $url = U('addon/Student/Wap/score', array('publicid' => $this->public_id, 'studentno' => $value['studentno']));
            //var_dump($value);
            $retdata = D('WxyScore')->send_score_to_user($value['openid'], $url, $value, $this->token, $this->school);
            if ($retdata["errcode"] == 0)
                usleep(30000);
            else
                usleep(1000);
        };

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

    function post($url, $param = array())
    {
        if (!is_array($param)) {
            throw new Exception("参数必须为array");
        }
        $httph = curl_init($url);
        curl_setopt($httph, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($httph, CURLOPT_SSL_VERIFYHOST, 1);
        curl_setopt($httph, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($httph, CURLOPT_USERAGENT, "Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.0)");
        curl_setopt($httph, CURLOPT_POST, 1);//设置为POST方式
        curl_setopt($httph, CURLOPT_POSTFIELDS, $param);
        curl_setopt($httph, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($httph, CURLOPT_HEADER, 1);
        $rst = curl_exec($httph);
        curl_close($httph);

        return $rst;
    }
}
