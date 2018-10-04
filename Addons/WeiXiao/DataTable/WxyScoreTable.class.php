<?php

/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2018/10/4
 * Time: 20:12
 * WxyScore数据模型
 */
class WxyScoreTable
{
    // 数据表模型配置
    public $config = [
        'name' => 'wxy_score',
        'title' => '成绩表',
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
            'field' => 'int(10) NULL',
            'remark' => '课程ID',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'course_name' => [
            'title' => '课程名称',
            'type' => 'string',
            'field' => 'varchar(200) NOT NULL',
            'remark' => '课程或考核名称',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'sequence' => [
            'title' => '课程序号',
            'type' => 'string',
            'field' => 'int(10) NULL',
            'remark' => '课程序号',
            'is_show' => 1,
            'is_must' => 0
        ],
        'classdate' => [
            'title' => '上课时间',
            'type' => 'string',
            'field' => 'datetime DEFAULT NULL',
            'remark' => '上课时间',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'sid' => [
            'title' => '学生ID',
            'type' => 'string',
            'field' => 'varchar(20) DEFAULT NULL',
            'remark' => '学生ID',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'studentno' => [
            'title' => '学号',
            'type' => 'string',
            'field' => 'varchar(20) DEFAULT NULL',
            'remark' => '学号',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'name' => [
            'title' => '姓名',
            'type' => 'string',
            'field' => 'varchar(50) DEFAULT NULL',
            'remark' => '姓名',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'termid' => [
            'title' => '测试编号',
            'type' => 'string',
            'field' => 'int(10) DEFAULT NULL',
            'remark' => '测试编号',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'term' => [
            'title' => '测试名称',
            'type' => 'string',
            'field' => 'varchar(100) DEFAULT NULL',
            'remark' => '测试名称',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'subject' => [
            'title' => '科目',
            'type' => 'string',
            'field' => 'varchar(60) DEFAULT NULL',
            'remark' => '科目',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'score' => [
            'title' => '总分数',
            'type' => 'string',
            'field' => 'varchar(50) DEFAULT NULL',
            'remark' => '总分数',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'score1' => [
            'title' => '分数一',
            'type' => 'string',
            'field' => 'varchar(50) DEFAULT NULL',
            'remark' => '分数一',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'score2' => [
            'title' => '分数二',
            'type' => 'string',
            'field' => 'varchar(50) DEFAULT NULL',
            'remark' => '分数一',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'score3' => [
            'title' => '分数三',
            'type' => 'string',
            'field' => 'varchar(50) DEFAULT NULL',
            'remark' => '分数三',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'award' => [
            'title' => '奖项',
            'type' => 'string',
            'field' => 'varchar(50) DEFAULT NULL',
            'remark' => '奖项',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'exmscore' => [
            'title' => '测试分数',
            'type' => 'string',
            'field' => 'varchar(50) DEFAULT NULL',
            'remark' => '测试分数',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'weixinmsgsend' => [
            'title' => '微信消息发送',
            'type' => 'string',
            'field' => 'varchar(50) DEFAULT NULL',
            'remark' => '微信消息发送',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'comment' => [
            'title' => '备注',
            'type' => 'string',
            'field' => 'varchar(200) DEFAULT NULL',
            'remark' => '备注',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'room' => [
            'title' => '教室',
            'type' => 'string',
            'field' => 'varchar(50) DEFAULT NULL',
            'remark' => '教室',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
    ];
}