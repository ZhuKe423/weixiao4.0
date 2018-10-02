<?php
/**
 * OaRole数据模型
 */
class OaRoleTable {
	// 数据表模型配置
	public $config = [
			'name' => 'oa_role',
			'title' => '用户角色',
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
			'name' => [
					'title' => '角色名称',
					'field' => 'varchar(100) NOT NULL',
					'type' => 'string',
					'is_must' => 1
			],
			'pid' => [
					'title' => '父角色id',
					'field' => 'int(10) NULL',
					'type' => 'string'
			],
			'sort' => [
					'title' => '排序',
					'field' => 'int(10) NULL',
					'type' => 'string'
			]
	];
}	