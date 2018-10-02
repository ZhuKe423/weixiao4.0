<?php
/**
 * OaCheckPoint数据模型
 */
class OaCheckPointTable {
	// 数据表模型配置
	public $config = [
			'name' => 'oa_check_point',
			'title' => '员工签到地址',
			'search_key' => '',
			'add_button' => 1,
			'del_button' => 1,
			'search_button' => 1,
			'check_all' => 1,
			'list_row' => 0,
			'addon' => 'OaSystem'
	];
	
	// 列表定义
	public $list_grid = [
			'type' => [
					'title' => '类型',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'location' => [
					'title' => '位置信息',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			]
	];
	
	// 字段定义
	public $fields = [
			'appid' => [
					'title' => '小程序appid',
					'field' => 'varchar(200) NOT NULL',
					'type' => 'string',
					'is_must' => 1,
					'placeholder' => '请输入内容'
			],
			'type' => [
					'title' => '类型',
					'type' => 'string',
					'field' => 'char(50) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'location' => [
					'title' => '位置信息',
					'type' => 'string',
					'field' => 'varchar(255) NOT NULL',
					'is_show' => 1,
					'is_must' => 1,
					'placeholder' => '请输入内容'
			]
	];
}	