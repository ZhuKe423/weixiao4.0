<?php
/**
 * OaProcessLog数据模型
 */
class OaProcessLogTable {
	// 数据表模型配置
	public $config = [
			'name' => 'oa_process_log',
			'title' => '审批申请处理记录',
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
			'application_id' => [
					'title' => '申请单号',
					'field' => 'int(10) NOT NULL',
					'type' => 'string',
					'is_must' => 1
			],
			'emp_id' => [
					'title' => '申请ID',
					'field' => 'int(10) NULL',
					'type' => 'string'
			],
			'approver' => [
					'title' => '经办人ID',
					'field' => 'int(10) NULL',
					'type' => 'string'
			],
			'dept_id' => [
					'title' => '部门ID',
					'field' => 'int(10) NULL',
					'type' => 'string'
			],
			'step' => [
					'title' => '级数',
					'field' => 'int(10) NULL',
					'type' => 'string'
			],
			'status' => [
					'title' => '状态',
					'field' => 'varchar(255) NULL',
					'type' => 'string'
			],
			'result' => [
					'title' => '结果',
					'field' => 'char(50) NULL',
					'type' => 'string'
			],
			'comment' => [
					'title' => '审批意见',
					'field' => 'varchar(255) NULL',
					'type' => 'string'
			],
			'time' => [
					'title' => '时间戳',
					'field' => 'int(10) NULL',
					'type' => 'string'
			]
	];
}	