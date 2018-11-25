<?php
/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2018/11/2
 * Time: 9:34
 */

namespace Addons\WeiXiao\Model;
use Think\Model;

class WxyCourseModel extends Model
{
    protected $tableName = 'wxy_course';
    function addCourse($data) {
        $map['token'] = $data['token'];
        $map['name'] = $data['name'];
        $map['grade'] = $data['grade'];
        $map['teacher'] = $data['teacher'];
        $map['site'] = $data['site'];
        $map['season'] = $data['season'];
        if ($data['name'] == '') return;
        $result = $this->where($map)->find();

        //dump($map);
        //dump($result);
        if ($result == null) {
            return $this->add($data);
        }
        else{
            $this->where($map)->save($data);
            return $result['id'];
        }
    }
//    function addCourseId($data)
//    {
//        $map['token'] = $data['token'];
//        $map['name'] = $data['name'];
//        $map['grade'] = $data['grade'];
//        $map['teacher'] = $data['teacher'];
//        $map['site'] = $data['site'];
//        if ($data['name'] == '') return;
//        $result = $this->where($map)->find();
//        //dump($map);
//        //dump($result);
//        if ($result == null) {
//            $this->add($data);
//        }
//    }

    }