<?php
/**
 * OaServiceOrder数据模型
 */
class OaServiceOrderTable {
	// 数据表模型配置
	public $config = [
			'name' => 'oa_service_order',
			'title' => '商品订单',
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
			'emp_name' => [
					'title' => '员工姓名',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'products' => [
					'title' => '预定商品',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'type' => [
					'title' => '订单类型',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'create_time' => [
					'title' => '创建时间',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'pay_cash' => [
					'title' => '总金额',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'is_cancel' => [
					'title' => '是否撤单',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			]
	];
	
	// 字段定义
	public $fields = [
			'appid' => [
					'title' => '小程序appid',
					'field' => 'varchar(255) NOT NULL',
					'type' => 'string',
					'is_must' => 1,
					'placeholder' => '请输入内容'
			],
			'type' => [
					'title' => '订单类型',
					'type' => 'string',
					'field' => 'char(50) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'emp_id' => [
					'title' => 'OAuserId',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'emp_name' => [
					'title' => '员工姓名',
					'type' => 'string',
					'field' => 'varchar(255) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'products' => [
					'title' => '预定商品',
					'type' => 'string',
					'field' => 'text NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'comment' => [
					'title' => '备注',
					'type' => 'string',
					'field' => 'varchar(255) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'create_time' => [
					'title' => '创建时间',
					'type' => 'string',
					'field' => 'int(10) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'is_cancel' => [
					'title' => '是否撤单',
					'type' => 'string',
					'field' => 'tinyint(2) NOT NULL',
					'is_show' => 1,
					'is_must' => 1,
					'placeholder' => '请输入内容'
			],
			'status' => [
					'title' => '状态',
					'type' => 'string',
					'field' => 'varchar(255) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'pay_cash' => [
					'title' => '总金额',
					'type' => 'string',
					'field' => 'float(10,2) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'deptid' => [
					'title' => '部门ID',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			]
	];
}	