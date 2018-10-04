<?php

/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2018/10/4
 * Time: 14:51
 * WxyStudyMaterial数据模型
 */
class WxyStudyMaterialTable
{
// 数据表模型配置
    public $config = [
        'name' => 'wxy_study_material',
        'title' => '学习资料表',
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
        'subject' => [
            'title' => '科目',
            'field' => 'varchar(60) NULL',
            'type' => 'string',
            'remark' => '科目',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'title' => [
            'title' => '标题',
            'field' => 'varchar(200) NULL',
            'type' => 'string',
            'remark' => '标题',
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
        'fileid' => [
            'title' => '文件ID',
            'field' => 'int(10) NULL',
            'type' => 'string',
            'remark' => '文件ID',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'order' => [
            'title' => '订阅人数',
            'field' => 'int(10) NULL',
            'type' => 'string',
            'remark' => '订阅人数',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'stage' => [
            'title' => '阶段',
            'field' => 'varchar(60) NULL',
            'type' => 'string',
            'remark' => '阶段（小学、初中、高中、通用）',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'description' => [
            'title' => '描述',
            'field' => 'text NULL',
            'type' => 'string',
            'remark' => '描述',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
    ];
}