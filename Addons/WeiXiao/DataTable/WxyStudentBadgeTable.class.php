<?php

/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2018/10/4
 * Time: 19:43
 * WxyStudentBadge数据模型
 */
class WxyStudentBadgeTable
{
// 数据表模型配置
    public $config = [
        'name' => 'wxy_student_badge',
        'title' => '考勤卡表',
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
            'field' => 'varchar(100) NOT NULL',
            'remark' => '机构Token',
            'is_show' => 0,
            'is_must' => 1
        ],
        'updatetime' => [
            'title' => '更新时间',
            'field' => 'int(10) NULL',
            'type' => 'string',
            'remark' => '更新时间',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'cardno' => [
            'title' => 'Rfid号',
            'field' => 'varchar(255) NULL',
            'type' => 'string',
            'remark' => 'Rfid号',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'studentno' => [
            'title' => '学号',
            'field' => 'varchar(20) NULL',
            'type' => 'string',
            'remark' => '学号',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'name' => [
            'title' => '姓名',
            'field' => 'varchar(50) NULL',
            'type' => 'string',
            'remark' => '姓名',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'serial_no' => [
            'title' => '序列号',
            'field' => 'varchar(255) NULL',
            'type' => 'string',
            'remark' => '卡面序列号',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'type' => [
            'title' => '卡类型',
            'field' => 'varchar(20) NULL',
            'type' => 'string',
            'remark' => '卡类型：临时，正式',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ]
    ];
}