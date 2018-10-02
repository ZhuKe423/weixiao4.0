<?php
/**
 * OaApplication数据模型
 */
class OaApplicationTable {
	// 数据表模型配置
	public $config = [
			'name' => 'oa_application',
			'title' => '审批申请',
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
			'id' => [
					'title' => 'ID主键',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 1
			],
			'applyer' => [
					'title' => 'OAuserId',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'submit_date' => [
					'title' => '提交日期',
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
			'type' => [
					'title' => '类型',
					'type' => 'string',
					'field' => 'char(50) NOT NULL',
					'is_show' => 1,
					'is_must' => 1,
					'placeholder' => '请输入内容'
			],
			'applyer' => [
					'title' => 'OAuserId',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'dept_id' => [
					'title' => '部门ID',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'description' => [
					'title' => '描述',
					'field' => 'varchar(255) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'statement' => [
					'title' => '声明',
					'field' => 'varchar(255) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'pictures' => [
					'title' => '图片',
					'field' => 'varchar(255) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'status' => [
					'title' => '状态',
					'field' => 'varchar(255) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'signature' => [
					'title' => '签名',
					'field' => 'varchar(255) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'step' => [
					'title' => '级数',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'submit_date' => [
					'title' => '提交日期',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'approve_date' => [
					'title' => '通过日期',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'approver' => [
					'title' => '当前审批人',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'is_read' => [
					'title' => '已读',
					'field' => 'tinyint(2) NOT NULL',
					'type' => 'string',
					'is_must' => 1,
					'placeholder' => '请输入内容'
			],
			'is_del' => [
					'title' => '撤销',
					'field' => 'tinyint(2) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			]
	];
}	