<?php
/**
 * OaDuty数据模型
 */
class OaDutyTable {
	// 数据表模型配置
	public $config = [
			'name' => 'oa_duty',
			'title' => '职务信息',
			'search_key' => '',
			'add_button' => 1,
			'del_button' => 1,
			'search_button' => 1,
			'check_all' => 1,
			'list_row' => 20,
			'addon' => 'OaSystem'
	];
	
	// 列表定义
	public $list_grid = [ ];
	
	// 字段定义
	public $fields = [
			'appid' => [
					'title' => '小程序appid',
					'field' => 'varchar(200) NULL',
					'type' => 'string'
			],
			'duty_no' => [
					'title' => '职务编号',
					'field' => 'varchar(255) NOT NULL',
					'type' => 'string',
					'is_must' => 1
			],
			'remark' => [
					'title' => '备注',
					'field' => 'varchar(255) NULL',
					'type' => 'string'
			],
			'name' => [
					'title' => '职务名称',
					'field' => 'varchar(255) NULL',
					'type' => 'string'
			],
			'is_del' => [
					'title' => '撤销',
					'field' => 'tinyint(2) NOT NULL',
					'type' => 'string',
					'is_must' => 1,
					'value' => 0
			]
	];
}	