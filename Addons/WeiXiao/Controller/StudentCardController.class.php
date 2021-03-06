<?php
/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2018/10/11
 * Time: 14:43
 */
namespace Addons\WeiXiao\Controller;

use Think\ManageBaseController;

class StudentCardController extends ManageBaseController
{
    protected $model;
    protected $token;
    protected $school;
    protected $schoolType;
    public function __construct() {
        if (_ACTION == 'show') {
            $GLOBALS ['is_wap'] = true;
        }

        parent::__construct ();
        $this->model = $this->getModel('WxyStudentCard'); //getModelByName ( $_REQUEST ['_controller'] );
        $this->token = get_token();
        $this->school = D('Common/Apps')->getInfoByToken($this->token, 'public_name');
        $this->schoolType = D('Common/Apps')->getInfoByToken($this->token, 'public_type');
        $this->config = getAddonConfig ( 'WeiXiao' );

        /*var_dump($this->model);
        var_dump($_REQUEST ['_controller']);

        exit();
        $this->model || $this->error ( '模型不存在！' );

        $this->assign ( 'model', $this->model );
        */

    }

    public function _initialize() {
        parent::_initialize();
        $act = strtolower(ACTION_NAME);

        $res ['title'] = '学员列表';
        $res ['url'] = U('lists');
        $res ['class'] = $act == 'lists' ? 'current' : '';
        $nav [] = $res;

        $res ['title'] = '添加学员';
        $res ['url'] = U('add');
        $res ['class'] = $act == 'add' ? 'current' : '';
        $nav [] = $res;

        $res ['title'] = '学员资料修改';
        $res ['url'] = U('edit');
        $res ['class'] = $act == 'edit' ? 'current' : '';
        $nav [] = $res;

        $res ['title'] = '注册登记';
        $res ['url'] = U('register');
        $res ['class'] = $act == 'register' ? 'current' : '';
        $nav [] = $res;

        $res ['title'] = '学员信息导入';
        $res ['url'] = U('import');
        $res ['class'] = $act == 'import' ? 'current' : '';
        $nav [] = $res;

        $res ['title'] = '学员调课处理';
        $res ['url'] = U('lesson_reschedule');
        $res ['class'] = $act == 'lesson_reschedule' ? 'current' : '';
        $nav [] = $res;

        $this->assign('nav', $nav);
    }

    /**
     * 显示指定模型列表数据
     */
    public function  lists() {
        parent::common_lists($this->model);
    }

    public function register ()
    {
        /*// 获取模型信息
        $model = $this->model;
        // 解析列表规则
        $list_data = $this->_list_grid($model);
        $grids = $list_data ['list_grids'];
        $fields = $list_data ['fields'];
        foreach ($grids as $v) {
            if ($v ['come_from'] == 1) {
                array_pop($grids);
            } else {
                $ht [$v ['name']] = $v ['title'];
            }
        }
        $dataArr [0] = $ht;

        $dataTable = D('Common/Model')->getFileInfo($model);
        $extra = $dataTable->fields["pay_status"]["extra"];
        $enum = parse_config_attr($extra);
        dump($dataTable);
        dump($enum);

        $extra = $dataTable->fields["grade"]["extra"];
        $enum = parse_config_attr($extra);
        dump($enum);*/


        $model = $this->model;
        $studentno = I ( 'studentno' );
        $map['token'] = $this->token;
        $map['studentno'] = $studentno;

        // 获取数据
        $data = M ( get_table_name ( $model ['id'] ) )->where($map)->find ();

        //dump($studentno);
        $data || $is_new = true;
        $data && $studentno = $data['studentno'];

        $token = get_token ();
        if (isset ( $data ['token'] ) && $token != $data ['token'] && defined ( 'ADDON_PUBLIC_PATH' )) {
            $this->error ( '100005:非法访问！' );
        }

        $cmap['token'] = $this->token;
        $cmap['status'] = array('lt',3); //上架或即将上架课程
        $course_data = M('WxyCourse')->where($cmap)->order('season desc, grade desc')->select();
        foreach ($course_data as $key => $vo) {
            $course_data[$key]['grade'] = $this->config['grade_value'][$vo['grade']];
        }

        if (IS_POST) {
            $Model = D ( parse_name ( get_table_name ( $model ['id'] ), 1 ) );
            // 获取模型的字段信息
            $Model = $this->checkAttr ( $Model, $model ['id'] );
            if ($is_new) {
                if ($Model->create () && false !== $Model->add ()) {
                    $this->_saveKeyword ( $model, $studentno );
                    // 清空缓存
                    method_exists ( $Model, 'clear' ) && $Model->clear ( $studentno, 'edit' );
                    $this->success ( '保存' . $model ['title'] . '成功！', U('register?studentno='. I('post.studentno')));
                } else {
                    $this->error ( '100006:' . $Model->getError () );
                }
            }
            else {
                if ($Model->create () && false !== $Model->save ()) {
                    $this->_saveKeyword ( $model, $studentno );
                    // 清空缓存
                    method_exists ( $Model, 'clear' ) && $Model->clear ( $studentno, 'edit' );
                    $this->success ( '保存' . $model ['title'] . '成功！' );
                } else {
                    $this->error ( '100006:' . $Model->getError () );
                }
            }

        } else {

            $view_data = D('WxyStudentCourseView')->where($map)->select();
            $student_course = array();
            foreach($view_data as $key => $vo) {
                $item['id'] = $key;
                $item['c_id'] = $vo['courseid'];
                $item['bat'] = $vo['bat'];
                $item['course_item'] = $vo['courseid'] . '.'. $vo['site']. ' '. $this->config['grade_value'][$vo['grade']]. ' '. $vo['course_name'] . ' '. $vo['teacher'] . '老师';
                $item['course_value'] = $vo['courseid'];
                $item['lesson_item'] = $vo['bat_no'] . "课时第" . $vo['sequence'] . "次时段：" . $vo['classdate'] . "--教室：" . $vo['room'];
                $item['lesson_value'] = $vo['bat_no'];
                array_push($student_course, $item);
            }

            $fields = get_model_attribute ( $model ['id'] );
            $this->assign ( 'fields', $fields );
            $this->assign ( 'data', $data );
            $is_new ? $this->assign('is_new', 1): $this->assign('is_new', 0);
            $this->assign('course_list', $course_data);
            $this->assign ( 'studentno', $studentno );
            $this->assign('submit_name', '添加、修改学员信息点确认');
            $this->assign('student_course', $student_course);

            $this->display ("register");
        }
    }

    public function lesson_reschedule ()
    {
        $model = $this->model;
        $studentno = I ( 'studentno' );
        $map['token'] = $this->token;
        $season_list = M('wxy_course_season')->where($map)->select();
        $this->assign('season_list', $season_list);  //get course_season data.

        $map['studentno'] = $studentno;

        // 获取数据
        $data = M ( get_table_name ( $model ['id'] ) )->where($map)->find ();

        //dump($studentno);
        $data || $is_new = true;
        $data && $studentno = $data['studentno'];

        $token = get_token ();
        if (isset ( $data ['token'] ) && $token != $data ['token'] && defined ( 'ADDON_PUBLIC_PATH' )) {
            $this->error ( '100005:非法访问！' );
        }

        $cmap['token'] = $this->token;
        $cmap['status'] = array('lt',3); //上架或即将上架课程
        $course_data = D('WxyCourse')->where($cmap)->order('season desc, grade asc')->select();
        foreach ($course_data as $key => $vo) {
            $course_data[$key]['grade'] = $this->config['grade_value'][$vo['grade']];
        }
        $this->assign('course_list', $course_data);

        $cmap['studentno'] = $studentno; //学生选课记录
        $course_data = D('WxyStudentCourseView')->where($cmap)->order('season desc, status asc')->select();
        foreach ($course_data as $key => $vo) {
            $course_data[$key]['grade'] = $this->config['grade_value'][$vo['grade']];
        }
        $this->assign('student_course_list', $course_data);

        if (IS_POST) {
            $_post = I('post.');
            $Model = D('WxyStudentCourseView');

            $studentno = $_post['studentno'];
            $sid =  $_post['id'];
            $post_data = array();
            $course_adj = array();
            $lesson_adj = array();
            foreach ($_post as $key => $vo) {
                $key_array = explode('_',$key);

                switch ($key_array['1']) {
                    case 'c':
                        $d_key =  $key_array['2'];
                        $course_adj[$key_array['0']][$d_key]['courseid'] = $vo;
                        break;
                    case 'l':
                        $d_key =  $key_array['2'];
                        $lesson_adj[$key_array['0']][$d_key]['lesson_id'] = $vo;
                        break;
                    default:
                        break;
                }

            }

            foreach($course_adj['out'] as $key => $vo) {
                $post_data['out'][$vo['courseid']][] = $lesson_adj['out'][$key]['lesson_id'];
            }
            foreach($course_adj['in'] as $key => $vo) {
                $post_data['in'][$vo['courseid']][] = $lesson_adj['in'][$key]['lesson_id'];
            }

            //dump($post_data);
            if ((D('WxyStudentLesson')->reschedule($this->token, $studentno, $post_data)))
                $this->success("课时调整成功!", U('lists'));
            else
                $this->error("数据有误，调入课时大于调出课时，请检查后再提交！");
            return;

            // 获取模型的字段信息


        } else {

            $view_data = D('WxyStudentCourseView')->where($map)->select();
            $student_course = array();
            foreach($view_data as $key => $vo) {
                $item['id'] = $key;
                $item['c_id'] = $vo['courseid'];
                $item['bat'] = $vo['bat'];
                $item['course_item'] = $vo['courseid'] . '.'. $vo['site']. ' '. $this->config['grade_value'][$vo['grade']]. ' '. $vo['course_name'] . ' '. $vo['teacher'] . '老师';
                $item['course_value'] = $vo['courseid'];
                $item['lesson_item'] = $vo['bat_no'] . "课时第" . $vo['sequence'] . "次时段：" . $vo['classdate'] . "--教室：" . $vo['room'];
                $item['lesson_value'] = $vo['bat_no'];
                array_push($student_course, $item);
            }

            $fields = get_model_attribute ( $model ['id'] );
            $this->assign ( 'fields', $fields );
            $this->assign ( 'data', $data );
            $is_new ? $this->assign('is_new', 1): $this->assign('is_new', 0);
            $this->assign ( 'studentno', $studentno );
            $this->assign('submit_name', '添加、修改学员信息点确认');
            $this->assign('student_course', $student_course);

            $this->display ("lesson_reschedule");
        }
    }


    public function course_reg() {
        $_post = I('post.');
        if (I('post.id') == null) {
            $this->error("先确定学员资料后方能提交选课信息！");
        }
        if(IS_POST) {
            $studentno = $_post['studentno_old'];
            $sid =  $_post['id'];
            foreach ($_post as $key => $vo) {
                $key_array = explode('_',$key);

                switch ($key_array['0']) {
                    case 'c':
                        $d_key =  $key_array['1'];
                        $data[$d_key]['courseid'] = $vo;
                        $data[$d_key]['studentno'] = $studentno;
                        $data[$d_key]['sid'] = $sid;
                        $data[$d_key]['token'] = $this->token;
                        $data[$d_key]['timestamp'] = time();
                        $data[$d_key]['status'] = '0';
                        $data[$d_key]['opcode'] = '0';
                        break;
                    case 'l':
                        $d_key =  $key_array['1'];
                        $data[$d_key]['bat_no'] = $vo;
                        break;
                    default:
                        break;
                }
                //$data['studentno'] =
            }
            $map['token'] = $this->token;
            $map['studentno'] = $studentno;
            M('WxyStudentCourse')->where($map)->delete();
            foreach ($data as $vo) {
                $result = M('WxyStudentCourse')->add($vo);
            }

            if ($result===false) $this->error('选课信息提交失败！');
            else $this->success('选课信息提交成功！', U('register?studentno='. $studentno));
        }
    }

    public function edit(){

        parent::common_edit($this->model);
    }

    public function add(){
        parent::common_add($this->model);
    }
    public function del(){
        parent::common_del($this->model);
    }
    /*public function edit() {
        //var_dump($sid);
        $model = D('WxyStudentCard');

        if (IS_POST) {
            $data = I('post.data');
            $sid = I('post.id');
            //var_dump($data);

            $data['gender'] = I('post.gender');
            $data['grade'] = I('post.grade');
            $data['name'] = I('post.name');
            $data['phone'] = I('post.phone');
            $data['school'] = I('post.school');

            $map['id'] = $sid;
            $map['token'] = $this->token;
            $model->where($map)->save($data);
            $this->success("学生资料更新成功！");
        }
        else {
            if (I('id') == NULL) $this->error("学生ID未输入！");
            $sid  = intval(I('id'));
            $map['id'] = $sid;
            $data = $model->where($map)->find();
            $this->assign('data', $data);

            if (strpos($this->schoolType, '全日制') !== false) {
                $this->assign('school_type', 1);
            }
            else
                $this->assign('school_type', 0);
            $this->display('edit');
        }
    }*/

    public function comment() {
        $studnetModel = D('WxyStudentCard');
        $scoreModel = M('wxy_score');
        $commentModel = M('wxy_course_comments');
        $page = I('request.p');

        if (IS_POST) {

            $data['sid'] = I('post.id');
            /*var_dump(strstr(I('post.course'), '.', true));
            var_dump(intval(strstr(I('post.course'), '.', true)));*/

            $data['courseid'] = intval(strstr(I('post.course'),'.', true));
            $data['studentno'] = I('post.studentno');
            $data['comments_txt'] = I('post.comment_txt');
            $data['name'] = I('post.name');
            //$data['phone'] = I('post.phone');
            $data['token'] = $this->token;
            $data['timestamp'] = date("Y-m-d H:i:s");

            $commentModel->add($data);
            //var_dump($data);
            //var_dump(I('request.p'));
            $this->success("学生评语已经添加！", U('addon/Student/Student/lists'. '/p/'. $page ));
        }
        else {
            if (I('id') == NULL) $this->error("学生ID未输入！");
            $sid  = intval(I('id'));
            $map['id'] = $sid;
            $map['token'] = $this->token;
            /*var_dump($map);*/
            $student = $studnetModel->where($map)->find();
            /*var_dump($student);*/
            unset($map);
            $map['studentno'] = $student['studentno'];
            $map['token'] = $this->token;
            $courseData = $scoreModel->where($map)->select();

            foreach($courseData as $key => $value) {
                $course[$value['courseid']] = $value['courseid'];
                /*echo $key."=>".$value['courseid']."\n";*/
            }
            $i = 0;
            foreach($course as $key => $value) {
                $couresSelected[$i] = M('wxy_course')->where('id ='.$value )->find();
                /*var_dump($value);*/
                /*var_dump($couresSelected[$i]);*/
                $i++;
            }
            /*var_dump($couresSelected);*/
            /*var_dump($course);*/

            $this->assign('couresSelected', $couresSelected);
            $this->assign('student', $student);
            $this->display('comment');
            /*$data = $studnetModel->where($map)->find();
            $this->assign('data', $data);
            //var_dump($data);
            $this->display('edit');*/
        }
    }

    public function import(){

        //var_dump($this->mid);
        //U('edit', array('id'=>I('request.id')));
        $uid = $this->uid;
        $token = $this->token;
        //$file_id = 7;
        //$data = $this->import_student_data_from_excel($file_id);
        //if ($uid == 0) redirect(U('/Home/Public'));
        if (IS_POST) {
            $data['uid'] = $uid;
            $data['token'] = $token;
            $data['file'] = I('post.file_id');
            $data['date'] = date('Y-m-d');
            $data['comment'] = I('post.comment');
            $data['model_id'] = $this->model['id'];
            $data['model_name'] = $this->model['name'];
            $season = I('post.season_id');
            if (!intval($data['file'])) $this->error("数据文件未上传！");
            $import_model = M('WxyModelImport');
            $import_model->add($data);
//            $this->import_student_data_from_excel($data['file']);
            if ($this->import_student_data_from_excel($data['file'], $season)) //import student data from uploaded Excel file.
                $this->success('保存成功！', U('lists'/*'import?model=' . $this->model ['name'], $this->get_param */), 600);
            else
                $this->error('请检查文件格式');
        }
        else {
            $map['token'] = $this->token;
            $season_list = M('wxy_course_season')->where($map)->select();
            $this->assign('season_list', $season_list);
            $this->display();
        }
    }

    private function zh_grade($grade) {
        $grade = is_string($grade)? intval($grade): $grade;

        switch ($grade) {
            case 1:
                $grade = '小学一年级';
                break;
            case 2:
                $grade = '小学二年级';
                break;
            case 3:
                $grade = '小学三年级';
                break;
            case 4:
                $grade = '小学四年级';
                break;
            case 5:
                $grade = '小学五年级';
                break;
            case 6:
                $grade = '小学六年级';
                break;
            case 7:
                $grade = '初中一年级';
                break;
            case 8:
                $grade = '初中二年级';
                break;
            case 9:
                $grade = '初中三年级';
                break;
            case 10:
                $grade = '高中一年级';
                break;
            case 11:
                $grade = '高中二年级';
                break;
            case 12:
                $grade = '高中三年级';
                break;
            default:

        }
        return $grade;
    }

    //This function was modified for full time school under Weixiao addon.
    private function import_student_data_from_excel($file_id, $season) {
        $subject = array(
            'H' => 'chinese',
            'I' => 'math',
            'J' => 'english',
            'K' => 'chemistry',
            'L' => 'physics',
            'M' => 'biology',
        );
        $data = array();
        $column = array (
            'A' => 'studentno',
            'B'=>'grade',
            'C'=>'name',
            'D'=>'gender',
            'E'=>'school',
            'F'=>'phone',
            'G'=>'phone_bck',
            'H' => 'chinese',
            'I' => 'math',
            'J' => 'english',
            'K' => 'chemistry',
            'L' => 'physics',
            'M' => 'biology',
            'N' => 'pay_status',
        );
        $l_map['season'] = $season;
        $l_map['token'] = $this->token;
        $data = D('WxyCourseLessonView')->where($l_map)->order('bat asc')->select();
        $lesson = array(); //course bat info stored in this variable.
        foreach ($data as $key => $vo) {
            $lesson[$vo['bat']] = $vo['courseid'];
        }

        $data = importFormExcel($file_id, $column, array(), 3); //read excel file from start_row!
        //var_dump($data);
        //exit();
        $student_model = D('WxyStudentCard');
        //var_dump($student_model);
        if ($data['status']) {
            foreach  ($data['data'] as $row) {
                $row['token'] = $this->token;
                $row['uid'] = $this->uid;
                $row['phone'] = strval($row['phone']);
                $row['phone_bck'] = strval($row['phone_bck']);
                $row['pay_status'] = strval(array_search($row['pay_status'], $this->config['pay_status']));
                $row['gender'] == '女' && $row['gender'] = 1;
                $row['gender'] == '男' && $row['gender'] = 0;

                $map['token'] =$row['token'];
                $map['studentno'] = $row['studentno'];
                $map['grade'] =$row['grade'];
                $student = $student_model->where($map)->find();
                if(empty($student)){
                    $student_model->addStudent($row);
                }
                else{
                    $sid = $student['id'];
                    $student_model->where($map)->save($row);
                }
                $row1['season'] = $season;
                $row1['token'] = $this->token;
                $row1['studentno'] = $row['studentno'];
                $row1['sid'] = $sid;
                $student_course_model = M('WxyStudentCourse');
                foreach ($subject as $key => $vo) {
                    $row1['bat_no'] = $row[$vo];
                    if (!empty($row1['bat_no'])) {
                        if (empty($student_course_model->where($row1)->find())) {
                            $row1['courseid'] = $lesson[$row1['bat_no']];
                            $row1['timestamp'] = time();
                            $student_course_model->add($row1);
                        }
                    }
                }
            }
            return true;
        }
        else return false;
    }

    public function get_1st_lesson() {
        if (IS_POST ||IS_AJAX) {
            $map["courseid"] = I("course_id");
            $map["token"] = $this->token;
            $map["sequence"] = 1;
            $model = D("WxyCourseLessonView");
            $data = $model->where($map)->select();
            /*$lesson_one = array();
            $bat = 0;
            foreach ($data as $key => $vo) {
               if(intval($vo['bat']) !=$bat ) {
                   $lesson_one[] = $vo;
                   $bat = intval($vo['bat']);
               }
            }*/
            //$json_data = json_encode($data);
            $this->ajaxReturn($data);
        }
        else {
            $map["courseid"] = I("course_id");
            $map["token"] = $this->token;
            $map["sequence"] = 1;
            $model = D("WxyCourseLessonView");
            $data = $model->where($map)->select();
            $this->ajaxReturn($data);
        }
    }

    public function get_course_lesson() {
        if (IS_POST ||IS_AJAX) {
            $map["courseid"] = I("course_id");
            $map["token"] = $this->token;
            $model = D("WxyCourseLessonView");
            $data = $model->where($map)->order('bat desc, sequence asc')->select();
            $this->ajaxReturn($data);
        }
        else {
            $map["courseid"] = I("course_id");
            $map["token"] = $this->token;
            $model = D("WxyCourseLessonView");
            $data = $model->where($map)->order('bat desc, sequence asc')->select();
            $this->ajaxReturn($data);
        }
    }

    public function get_student_lesson() {
        if (IS_POST ||IS_AJAX) {
            $map["studentno"] = I("studentno");
            $map["courseid"] = I("course_id");
            $map["token"] = $this->token;
            $data = D('WxyStudentLesson')->get_student_lesson_by_course($map["studentno"], $map["courseid"], $map["token"]);
            $this->ajaxReturn($data);
        }
        else {
            $map["studentno"] = I("studentno");
            $map["courseid"] = I("course_id");
            $map["token"] = $this->token;
            $data = D('WxyStudentLesson')->get_student_lesson_by_course($map["studentno"], $map["courseid"], $map["token"]);
            $this->ajaxReturn($data);
        }
    }

    public function get_student_course() {
        if (IS_POST ||IS_AJAX) {
            //$map["season"] = I("season");
            $map["studentno"] = I("studentno");
            $map["token"] = $this->token;
            $map['status'] = array('lt',3);
            //$map["sequence"] = 1;
            $model = D("WxyStudentCourseView");
            $data = $model->where($map)->order('season desc, status asc')->select();
            foreach ($data as $key => $vo) {
                $data[$key]['grade'] = $this->config['grade_value'][$vo['grade']];
            }
            $this->ajaxReturn($data);
        }
        else {
            //$map["season"] = I("season");
            $map["studentno"] = I("studentno");
            $map["token"] = $this->token;
            $map['status'] = array('lt',3);
            //$map["sequence"] = 1;
            $model = D("WxyStudentCourseView");
            $data = $model->where($map)->order('season desc, status asc')->select();
            foreach ($data as $key => $vo) {
                $data[$key]['grade'] = $this->config['grade_value'][$vo['grade']];
            }
            $this->ajaxReturn($data);
        }
    }


    function get_student_info() {
        if (IS_POST ||IS_AJAX) {
            $map["studentno"] = I("studentno");
            $map["token"] = $this->token;
            $model = D("WxyStudentCard");
            $data = $model->where($map)->find();
            if ($data == null) {
                $this->ajaxReturn($data);
            }
            else {
                $data['grade'] = strval(array_search($data['grade'], $this->config['grade_value']));
                $data['gender'] = strval(array_search($data['gender'], $this->config['gender_value']));

                //$json_data = json_encode($data);
                $this->ajaxReturn($data);
            }
        }
    }
}