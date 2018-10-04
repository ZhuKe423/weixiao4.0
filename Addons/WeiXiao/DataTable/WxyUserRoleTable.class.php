<?php

/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2018/10/4
 * Time: 19:54
 * WxyUserRole数据模型
 */
class WxyUserRoleTable
{
    // 数据表模型配置
    public $config = [
        'name' => 'wxy_user_role',
        'title' => '微信用户角色表',
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
            'type' => 'string',
            'field' => 'int(11) NULL',
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
        'm_role' => [
            'title' => '微信端用户角色',
            'field' => 'varchar(100) NULL',
            'type' => 'string',
            'remark' => '微角色：教务，普通',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'manger' => [
            'title' => '管理员',
            'field' => 'tinyint(2) NULL',
            'type' => 'string',
            'remark' => '管理员',
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