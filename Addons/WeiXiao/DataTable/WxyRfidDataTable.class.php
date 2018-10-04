<?php

/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2018/10/4
 * Time: 14:36
 * WxyRfidData数据模型
 */
class WxyRfidDataTable {
    // 数据表模型配置
    public $config = [
        'name' => 'wxy_rfid_data',
        'title' => 'Rfid卡基础信息表',
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
        'rfid_no' => [
            'title' => 'Rfid号',
            'field' => 'varchar(255) NULL',
            'type' => 'string',
            'remark' => 'Rfid号',
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
    ];
}