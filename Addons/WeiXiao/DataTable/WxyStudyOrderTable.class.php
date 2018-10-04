<?php

/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2018/10/4
 * Time: 15:03
 * WxyStudyOrderTable数据模型
 */
class WxyStudyOrderTable
{
// 数据表模型配置
    public $config = [
        'name' => 'wxy_study_order',
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
        'uid' => [
            'title' => '用户ID',
            'field' => 'int(11) NULL',
            'type' => 'string',
            'remark' => '用户ID',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'openid' => [
            'title' => '用户openid',
            'field' => 'varchar(100) NULL',
            'type' => 'string',
            'remark' => '用户openid',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'email' => [
            'title' => '电子邮箱',
            'field' => 'varchar(200) NULL',
            'type' => 'string',
            'remark' => '电子邮箱',
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
        'start' => [
            'title' => '起始时间',
            'field' => 'datetime NULL',
            'type' => 'string',
            'remark' => '起始时间',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'fill' => [
            'title' => '资料完备',
            'field' => 'tinyint(2) NULL',
            'type' => 'string',
            'remark' => '资料完备',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'status' => [
            'title' => '订阅状态',
            'field' => 'tinyint(2) NULL',
            'type' => 'string',
            'remark' => '订阅状态（1: 允许，0: 禁止）',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
    ];
}