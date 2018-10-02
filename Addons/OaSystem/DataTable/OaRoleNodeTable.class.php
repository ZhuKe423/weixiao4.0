<?php
/**
 * OaRoleNode数据模型
 */
class OaRoleNodeTable {
	// 数据表模型配置
	public $config = [
			'name' => 'oa_role_node',
			'title' => '角色功能关系',
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
			'role_id' => [
					'title' => '角色ID',
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
			'admin' => [
					'title' => '管理',
					'field' => 'tinyint(2) NULL',
					'type' => 'string'
			],
			'read' => [
					'title' => '读',
					'field' => 'tinyint(2) NULL',
					'type' => 'string'
			],
			'write' => [
					'title' => '写',
					'field' => 'tinyint(2) NULL',
					'type' => 'string'
			]
	];
}	