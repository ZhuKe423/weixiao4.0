<?php

/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2018/10/4
 * Time: 19:16
 * WxyDailyTime数据模型
 */
class WxyDailyTimeTable
{
// 数据表模型配置
    public $config = [
        'name' => 'wxy_daily_time',
        'title' => '考勤表',
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
        'studentID' => [
            'title' => '学号',
            'field' => 'varchar(255) NULL',
            'type' => 'string',
            'remark' => '学号',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'arriveTime' => [
            'title' => '到达时间',
            'field' => 'int(10) NULL',
            'type' => 'string',
            'remark' => '到达时间',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'leaveTime' => [
            'title' => '离开时间',
            'field' => 'int(10) NULL',
            'type' => 'string',
            'remark' => '离开时间',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'state' => [
            'title' => '状态',
            'field' => 'char(10) NULL',
            'type' => 'string',
            'remark' => '状态',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'valid' => [
            'title' => '有效',
            'field' => 'tinyint(2) NULL',
            'type' => 'string',
            'remark' => '是否有效',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'check_pos' => [
            'title' => '机位',
            'field' => 'varchar(50) NULL',
            'type' => 'string',
            'remark' => '考勤机位置',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
        'description' => [
            'title' => '备注说明',
            'field' => 'varchar(255) NULL',
            'type' => 'string',
            'remark' => '备注说明',
            'is_show' => 1,
            'placeholder' => '请输入内容'
        ],
    ];
}
