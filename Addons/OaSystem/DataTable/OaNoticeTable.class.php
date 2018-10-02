<?php
/**
 * OaNotice数据模型
 */
class OaNoticeTable {
	// 数据表模型配置
	public $config = [
			'name' => 'oa_notice',
			'title' => '公告信息',
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
			'title' => [
					'title' => '标题',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'type' => [
					'title' => '类型',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'to_users' => [
					'title' => '目标用户',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'dept_id' => [
					'title' => '部门ID',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'from_who' => [
					'title' => '来自于',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'create_time' => [
					'title' => '创建时间',
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
			'title' => [
					'title' => '标题',
					'type' => 'string',
					'field' => 'varchar(255) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'details' => [
					'title' => '通知内容',
					'type' => 'string',
					'field' => 'varchar(255) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'type' => [
					'title' => '类型',
					'type' => 'string',
					'field' => 'char(50) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'to_users' => [
					'title' => '目标用户',
					'type' => 'string',
					'field' => 'text NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'create_time' => [
					'title' => '创建时间',
					'type' => 'string',
					'field' => 'int(10) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'dept_id' => [
					'title' => '部门ID',
					'type' => 'string',
					'field' => 'int(10) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'from_who' => [
					'title' => '来自于',
					'type' => 'string',
					'field' => 'varchar(255) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'create_by_who' => [
					'title' => '创建者',
					'type' => 'string',
					'field' => 'int(10) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			]
	];
}	