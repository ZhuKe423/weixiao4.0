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

        /*var_dump($this->model);
        var_dump($_REQUEST ['_controller']);

        exit();
        $this->model || $this->error ( '模型不存在！' );

        $this->assign ( 'model', $this->model );
        */

    }

    /**
     * 显示指定模型列表数据
     */
    public function  lists() {
        parent::common_lists($this->model);
    }

    public function lists06789()
    {
        $page = I('p', 1, 'intval'); // 默认显示第一页数据

        // 解析列表规则
        $list_data = $this->_get_model_list($this->model);//_list_grid($this->model);
        $grids = $list_data ['list_grids'];
        $fields = $list_data ['fields'];

        // 关键字搜索
        $map ['token'] = get_token();
        $key = $this->model ['search_key'] ? $this->model ['search_key'] : 'title';

        if (isset ($_REQUEST [$key])) {
            $map [$key] = array(
                'like',
                '%' . htmlspecialchars($_REQUEST [$key]) . '%'
            );
            unset ($_REQUEST [$key]);
        }
        // 条件搜索
        foreach ($_REQUEST as $name => $val) {
            if (in_array($name, $fields)) {
                $map [$name] = $val;
            }
        }

        $row = empty ($this->model ['list_row']) ? 20 : $this->model ['list_row'];

        // 读取模型数据列表

        empty ($fields) || in_array('id', $fields) || array_push($fields, 'id');
        $name = parse_name(get_table_name($this->model ['id']), true);
        $data = M($name)->field(empty ($fields) ? true : $fields)->where($map)->order('id')->page($page, $row)->select();

        foreach ($data as $key => $val) {
            if ($val['grade'] != NULL) {
                $data[$key]['grade'] = $this->zh_grade($val['grade']);
            }
        }

        /* 查询记录总数 */
        $count = M($name)->where($map)->count();

        // 分页
        if ($count > $row) {
            $page = new \Think\Page ($count, $row);
            $page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
            $this->assign('_page', $page->show());
        }
        $this->assign('list_grids', $grids);
        $this->assign('list_data', $data);
        $this->assign('search_key', 'name');
        $this->meta_title = $this->model ['title'] . '列表';

        $this->display();
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
            if (!intval($data['file'])) $this->error("数据文件未上传！");
            $import_model = M('WxyModelImport');
            $import_model->add($data);
//            $this->import_student_data_from_excel($data['file']);
            if ($this->import_student_data_from_excel($data['file'])) //import student data from uploaded Excel file.
                $this->success('保存成功！', U('lists'/*'import?model=' . $this->model ['name'], $this->get_param */), 600);
            else
                $this->error('请检查文件格式');
        }
        else {
            $this->display();
        }
    }

    function _initialize() {
        parent::_initialize ();
        $act = strtolower ( ACTION_NAME );

        $res ['title'] = '列表';
        $res ['url'] = U ( 'lists' );
        $res ['class'] = $act == 'lists' ? 'current' : '';
        $nav [] = $res;

        $res ['title'] = '新增';
        $res ['url'] = U ( 'add' );
        $res ['class'] = $act == 'add' ? 'current' : '';
        $nav [] = $res;

        if ($act == 'add') {
            $res ['title'] = '编辑菜单';
            $res ['url'] = '###';
            $res ['class'] = 'current';
            $nav [] = $res;
        }
        $res ['title'] = '学生资料导入';
        $res ['url'] = U ( 'import' );
        $res ['class'] = $act == 'import' ? 'current' : '';
        $nav [] = $res;
        $this->assign ( 'nav', $nav );
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
    private function import_student_data_from_excel($file_id) {
        $data = array();
        $column = array (
            'A' => 'studentno',
            'B'=>'grade',
            'C'=>'name',
            'D'=>'gender',
            'E'=>'school',
            'F'=>'phone',
            'G'=>'phone_bck',
            'M'=>'pay_status',
        );
        $data = importFormExcel($file_id, $column, array(), 4); //read excel file from start_row!
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

                $row['pay_status'] = strval($row['pay_status']);
                $row['gender'] = ($row['gender'] == '男') ? 1 : 0;
                if ($row['gender'] == '女') $row['gender'] = 2;
                $map['token'] =$row['token'];
                $map['studentno'] =$row['studentno'];
                $map['grade'] =$row['grade'];

                if(empty($student_model->where($map)->find())){
                    //                   // dump(123);
                    $student_model->addStudent($row);
                }
                else{
//                    echo(123);
//                    dump($row);
                    $student_model->where($map)->save($row);
                }
            }

            return true;
        }
        else return false;
    }
}