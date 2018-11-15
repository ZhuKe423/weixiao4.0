<?php
/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2018/11/7
 * Time: 15:34
 */

namespace Addons\WeiXiao\Controller;

use Think\ManageBaseController;


class LessonController extends ManageBaseController
{
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
    /**
     * 显示指定模型列表数据
     */
    public function lists()
    {
        dump("11111");
        $seach_key = '';
        ((I('name') == '') || (I('name') == null)) || $seach_key = I('name');

        $lessonModel = $this->getModel('WxyCourseLesson');
        $courseModel = $this->getModel('WxyCourse');
        //$list_data = $this->_get_model_list($lessonModel);//_list_grid($this->model);
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

        $lessonDao = D('WxyCourseLesson');
        $db_prefix = C ( 'DB_PREFIX' );

        $page = I ( 'p', 1, 'intval' );
        $row = empty ($lessonModel) ? 20 : $lessonModel ['list_row'];
        $map ['token'] = get_token();
        dump($seach_key);
        if (!empty($seach_key)) $list_data = $lessonDao->table($db_prefix.'wxy_course_lesson cols, '.$db_prefix.'wxy_course co')->where('cols.courseid = co.id' . ' and co.name = ' . $seach_key)->field('cols.classdate as classdate, cols.classlen as classlen, co.name as name, co.teacher as teacher, co.grade as grade, cols.room as room, cols.site as site, cols.sequence as sequence')->order('cols.id asc')->page ( $page, $row )->select();
        else
            $list_data = $lessonDao->table($db_prefix.'wxy_course_lesson cols, '.$db_prefix.'wxy_course co')->where('cols.courseid = co.id')->field('cols.classdate as classdate, cols.classlen as classlen, co.name as name, co.teacher as teacher, co.grade as grade, cols.room as room, cols.site as site, cols.sequence as sequence')->order('cols.id asc')->page ( $page, $row )->select();

        $count = $lessonDao->table($db_prefix.'wxy_course_lesson cols, '.$db_prefix.'wxy_course co')->where('cols.courseid = co.id')->count();
        if ($count > $row) {
            $page = new \Think\Page ($count, $row);
            $page->setConfig('theme', '%FIRST% %UP_PAGE% %LINK_PAGE% %DOWN_PAGE% %END% %HEADER%');
            $this->assign('_page', $page->show());
        }
        foreach($list_data as &$row){
            $row['grade']= $this->config['grade_value'][$row['grade']];
        }
        $this->assign('list_grids', $grids);
        $this->assign('list_data', $list_data);
        $this->assign('search_key', 'name');
        $this->meta_title = $this->model ['title'] . '列表1';
        $this->display('lists');
    }
}