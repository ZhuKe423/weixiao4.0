<?php
/**
 * OaSysLog数据模型
 */
class OaSysLogTable {
	// 数据表模型配置
	public $config = [
			'name' => 'oa_sys_log',
			'title' => '操作Log',
			'search_key' => '',
			'add_button' => 1,
			'del_button' => 1,
			'search_button' => 1,
			'check_all' => 1,
			'list_row' => 0,
			'addon' => 'OaSystem'
	];
	
	// 列表定义
	public $list_grid = [ ];
	
	// 字段定义
	public $fields = [
			'appid' => [
					'title' => '小程序appid',
					'field' => 'varchar(200) NOT NULL',
					'type' => 'string',
					'is_must' => 1
			],
			'userid' => [
					'title' => 'OAuserId',
					'field' => 'int(10) NOT NULL',
					'type' => 'string',
					'is_must' => 1
			],
			'node_id' => [
					'title' => '功能ID',
					'field' => 'int(10) NOT NULL',
					'type' => 'string',
					'is_must' => 1
			],
			'time' => [
					'title' => '时间戳',
					'field' => 'int(10) NOT NULL',
					'type' => 'string',
					'is_must' => 1
			],
			'operate' => [
					'title' => '操作',
					'field' => 'char(50) NULL',
					'type' => 'string'
			]
	];
}	