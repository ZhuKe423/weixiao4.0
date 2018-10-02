<?php

/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2018/10/2
 * Time: 21:30
 * WxyCourseArrange数据模型
 *
 */
class WxyCourseArrangeTable
{
    // 数据表模型配置
    public $config = [
        'name' => 'wxy_course_arrange',
        'title' => '课程',
        'search_key' => '',
        'add_button' => 1,
        'del_button' => 1,
        'search_button' => 1,
        'check_all' => 1,
        'list_row' => 10,
        'addon' => 'WeiXiao'
    ];

    // 列表定义
    public $list_grid = [ ];

    // 字段定义
    public $fields = [
        'token' => [
            'title' => '机构Token',
            'type' => 'string',
            'field' => 'varchar(100) NULL',
            'remark' => '机构Token',
            'placeholder' => '请输入内容'
        ],
        'courseid' => [
            'title' => '课程ID',
            'type' => 'string',
            'field' => 'int(10) NOT NULL',
            'remark' => '课程ID',
            'is_show' => 1,
        ],
        'squence' => [
            'title' => '课程序号',
            'type' => 'string',
            'field' => 'int(10) NOT NULL',
            'remark' => '课程序号',
            'is_show' => 1,
        ],
        'classdate' => [
            'title' => '上课时间',
            'type' => 'string',
            'field' => 'datetime DEFAULT NULL',
            'remark' => '上课时间',
            'is_show' => 1,
        ],
        'classlen' => [
            'title' => '课时长度',
            'type' => 'string',
            'field' => 'int(8) DEFAULT NULL',
            'remark' => '课时长度',
            'is_show' => 1,
        ],
        'site' => [
            'title' => '校区',
            'type' => 'string',
            'field' => 'varchar(50) DEFAULT NULL',
            'remark' => '校区',
            'is_show' => 1,
        ],
        'room' => [
            'title' => '教室',
            'type' => 'string',
            'field' => 'varchar(50) DEFAULT NULL',
            'remark' => '教室',
            'is_show' => 1,
        ],
    ];
}