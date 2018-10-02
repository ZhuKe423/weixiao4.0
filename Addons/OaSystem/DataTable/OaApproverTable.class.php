<?php
/**
 * OaApprover数据模型
 */
class OaApproverTable {
	// 数据表模型配置
	public $config = [
			'name' => 'oa_approver',
			'title' => '经办人',
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
			'emp_id' => [
					'title' => '员工ID',
					'field' => 'int(10) NULL',
					'type' => 'string'
			],
			'roleId' => [
					'title' => '角色ID',
					'field' => 'int(10) NULL',
					'type' => 'string'
			],
			'step' => [
					'title' => '级数',
					'field' => 'int(10) NULL',
					'type' => 'string'
			],
			'dep_id' => [
					'title' => '部门id',
					'field' => 'int(10) NULL',
					'type' => 'string'
			],
			'apply_type' => [
					'title' => '审批类型',
					'field' => 'int(10) NULL',
					'type' => 'string'
			]
	];
}	