<?php
/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2018/10/10
 * Time: 13:36
 */

namespace Addons\WeiXiao\Controller;
use Think\WapBaseController;

class WapCourseController extends WapBaseController
{
    public function __construct() {
        if (_ACTION == 'show') {
            $GLOBALS ['is_wap'] = true;
        }
        parent::__construct ();
        $this->model = $this->getModel('WxyCourse'); //getModelByName ( $_REQUEST ['_controller'] );
        $this->token = get_token();
        $this->school = D('Common/Apps')->getInfoByToken($this->token, 'public_name');
        $this->config = getAddonConfig ( 'WeiXiao' );
        /*var_dump($this->model);
        var_dump($_REQUEST ['_controller']);

        exit();
        $this->model || $this->error ( '模型不存在！' );
        */
        $this->assign ( 'model', $this->model );

        $this->assign('nav',null);
        $config = getAddonConfig ( 'WeiSite' );
        $config ['cover_url'] = get_cover_url ( $config ['cover'] );
        $config['background_arr']=explode(',', $config['background']);
        $config ['background_id'] = $config ['background_arr'][0];
        $config ['background'] = get_cover_url ( $config ['background_id'] );
        $this->assign ( 'config', $config );
        //dump ( $config );
        // dump(get_token());

        // 定义模板常量
        $act = strtolower ( _ACTION );
        $temp = $config ['template_' . $act];
        $act = ucfirst ( $act );
        $this->assign ( 'page_title', $this->school. "：课程汇总");
        define ( 'CUSTOM_TEMPLATE_PATH', ONETHINK_ADDON_PATH . 'WeiSite/View/Template' );
    }

    function detail() {
        $map['id'] = I('id');
        $map['token'] = $this->token;
        $data = D('wxy_course')->where($map)->find();
        $grade = $this->config['grade_value'];
        if (($data == null) || ($data == '')) $this->error("课程ID错误！");
        $brief_intro = strip_tags($data['intro']);
        $cover = $this->get_img_url($data['cover'], $data['subject']);
        $this->assign('grade', $grade[$data['grade']]);
        $this->assign('course', $data);
        $this->assign('brief_intro', $brief_intro);
        $this->assign('cover_img', $cover);
        $this->display('detail');
    }

    function index() {
        $map['token'] = $this->token;
        $map['module'] = '0'; //课程幻灯片
        //$map['type'] = 1;
        $slides = D('wxy_slideshow')->where($map)->select();
        $this->assign('slides', $slides);
        $this->assign('slides_count', count($slides) - 1);

        $map['module'] = '1'; //专题幻灯片
        $slides = D('wxy_slideshow')->where($map)->select();
        //dump($slides);
        $course_map['token'] = $this->token;
        foreach ($slides as $key => $vo) {
            $course_map['id'] = $vo['url'];
            $course_data = D('wxy_course')->where($course_map)->find();
            if (!empty($course_data)) {
                //$slides[$key]['title'] = $course_data['name'];
                $slides[$key]['courseid'] = $course_data['id'];
            }
            unset($course_data);
        }
        $this->assign('typical_slides', $slides);

        unset($course_map);
        $course_map['token'] = $this->token;
        $course_map['status'] = array('lt',3);
        $course_map['top'] = '1';
        $data = D('wxy_course')->where($course_map)->order('id desc')->limit(0,16)->select();
        foreach ($data as $key => $vo) {
            $data[$key]['breif_intro'] = msubstr(strip_tags($vo['intro']), 0, 30);
            $data[$key]['img_url'] = $this->get_img_url($vo['cover'], $vo['subject']);
        }
        $this->assign('top_course', $data);

        $map['status'] = array('lt',3); //查询即将开课或进行中的课程！
        $course_data = array();
        $data = D('wxy_course')->where($map)->order('id desc')->limit(0,6)->select();
        foreach ($data as $key => $vo) {
            $data[$key]['breif_intro'] = msubstr(strip_tags($vo['intro']), 0, 30);
            $data[$key]['img_url'] = $this->get_img_url($vo['cover'], $vo['subject']);
        }
        $this->assign('new_data', $data);
        foreach ($this->config['grade_value'] as $key => $vo) {
            $map['grade'] = $key;
            $data = D('wxy_course')->where($map)->select();
            if (($data == '') || ($data == null)) continue;
            foreach ($data as $key0 => $vo0) {
                if ($vo0['cover'] == null || $vo0['cover'] == 0) {
                    $data[$key0]['cover'] = 0;
                    switch ($vo0['subject']) {
                        case '2' :
                            $data[$key0]['img'] = 'english_default.jpg';
                            break;
                        case '3' :
                            $data[$key0]['img'] = 'chinese_default.jpg';
                            break;
                        case '4' :
                            $data[$key0]['img'] = 'physics_default.jpg';
                            break;
                        case '5' :
                            $data[$key0]['img'] = 'chemical_default.jpg';
                            break;
                        default  :
                            $data[$key0]['img'] = 'science_default.jpg';
                    }
                }
            }

            //dump($data);
            $course_data[$key]['title'] = $vo . '课程';
            $course_data[$key]['data'] = $data;
        };
        //dump($course_data);
        $this->assign('course_data', $course_data);
        $this->display();
    }

    private function get_img_url ($cover, $subject)
    {
        if ($cover == null || $cover == 0) {
            switch ($subject)
            {
                case '2' :
                    $cover = 'english_default.jpg';
                break;
                case '3' :
                    $cover = 'chinese_default.jpg';
                break;
                case '4' :
                    $cover = 'physics_default.jpg';
                break;
                case '5' :
                    $cover = 'chemical_default.jpg';
                break;
                default  :
                    $cover = 'science_default.jpg';
            }
            return SITE_URL . '/Addons/WeiXiao/View/Public/MUI/images/' . $cover;
        }
        else {
            $url = get_cover_url($cover);
            return $url;
        }
    }
}