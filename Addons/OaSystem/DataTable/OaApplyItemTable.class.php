<?php
/**
 * OaApplyItem数据模型
 */
class OaApplyItemTable {
	// 数据表模型配置
	public $config = [
			'name' => 'oa_apply_item',
			'title' => '审批条目',
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
			'application_id' => [
					'title' => '申请ID',
					'field' => 'int(10) NOT NULL',
					'type' => 'string',
					'is_must' => 1
			],
			'title' => [
					'title' => '类别',
					'field' => 'varchar(255) NULL',
					'type' => 'string'
			],
			'pictures' => [
					'title' => '图片',
					'field' => 'varchar(255) NULL',
					'type' => 'string'
			],
			'content' => [
					'title' => '详细内容',
					'field' => 'text NULL',
					'type' => 'string'
			],
			'comment' => [
					'title' => '审批意见',
					'field' => 'varchar(255) NULL',
					'type' => 'string'
			]
	];
}	