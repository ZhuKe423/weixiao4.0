<?php

/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2018/10/4
 * Time: 20:14
 * WxyCourseComments数据模型
 */
class WxyCourseCommentsTable
{
    // 数据表模型配置
    public $config = [
        'name' => 'wxy_course_comments',
        'title' => '课程评语表',
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
        'comment_txt' => [
            'title' => '文字评语',
            'type' => 'string',
            'field' => 'varchar(200) DEFAULT NULL',
            'remark' => '文字评语',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'comment_voice' => [
            'title' => '语音评语',
            'type' => 'string',
            'field' => 'varchar(200) DEFAULT NULL',
            'remark' => '文字评语',
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
        'timestamp' => [
            'title' => '时标',
            'type' => 'string',
            'field' => 'datetime DEFAULT NULL',
            'remark' => '时标',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
    ];
}
