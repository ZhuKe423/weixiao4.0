<?php
/**
 * OaApplyType数据模型
 */
class OaApplyTypeTable {
	// 数据表模型配置
	public $config = [
			'name' => 'oa_apply_type',
			'title' => '审批类型',
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
					'field' => 'varchar(255) NULL',
					'type' => 'string'
			],
			'name' => [
					'title' => '名称',
					'field' => 'varchar(100) NULL',
					'type' => 'string'
			],
			'remark' => [
					'title' => '备注',
					'field' => 'varchar(200) NULL',
					'type' => 'string'
			]
	];
}	