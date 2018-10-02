<?php
/**
 * OaNode数据模型
 */
class OaNodeTable {
	// 数据表模型配置
	public $config = [
			'name' => 'oa_node',
			'title' => '功能模块信息',
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
					'field' => 'varchar(255) NOT NULL',
					'type' => 'string',
					'is_must' => 1
			],
			'name' => [
					'title' => '名称',
					'field' => 'varchar(100) NOT NULL',
					'type' => 'string',
					'is_must' => 1
			],
			'url' => [
					'title' => 'url',
					'field' => 'varchar(255) NOT NULL',
					'type' => 'string',
					'is_must' => 1
			],
			'icon' => [
					'title' => '图标',
					'field' => 'varchar(255) NULL',
					'type' => 'string'
			],
			'remark' => [
					'title' => '备注',
					'field' => 'varchar(255) NULL',
					'type' => 'string'
			],
			'sort' => [
					'title' => '排序',
					'field' => 'int(10) NULL',
					'type' => 'string'
			],
			'pid' => [
					'title' => '父功能ID',
					'field' => 'int(10) NULL',
					'type' => 'string'
			]
	];
}	