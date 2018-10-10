<?php

/**
 * WxyStudentCourse数据模型
 */
class WxyStudentCourseTable {
    // 数据表模型配置
    public $config = [
        'name' => 'wxy_student_course',
        'title' => '学员定课表',
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
        'studentno' => [
            'title' => '学号',
            'field' => 'varchar(20) NULL',
            'type' => 'string',
            'remark' => '学号',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'courseid' => [
            'title' => '课程ID',
            'field' => 'int(10) NULL',
            'type' => 'string',
            'remark' => '课程ID',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'lesson_id' => [
            'title' => '排课号',
            'field' => 'int(10) DEFAULT "1"',
            'type' => 'string',
            'remark' => '排课号',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'status' => [
            'title' => '状态',
            'field' => 'varchar(20) NULL',
            'type' => 'string',
            'remark' => '状态（临时、正常）',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'opcode' => [
            'title' => '操作员',
            'field' => 'varchar(20) NULL',
            'type' => 'string',
            'remark' => '操作员（教务、家长）',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'timestamp' => [
            'title' => '时标',
            'type' => 'string',
            'field' => 'datetime NULL',
            'remark' => '创建时标',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ]
    ];
}