<?php
/**
 * OaRoleDuty数据模型
 */
class OaRoleDutyTable {
	// 数据表模型配置
	public $config = [
			'name' => 'oa_role_duty',
			'title' => '角色职务关系',
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
			'duty_id' => [
					'title' => '职务ID',
					'field' => 'int(10) NOT NULL',
					'type' => 'string',
					'is_must' => 1
			]
	];
}	