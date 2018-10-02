<?php
/**
 * OaDept数据模型
 */
class OaDeptTable {
	// 数据表模型配置
	public $config = [
			'name' => 'oa_dept',
			'title' => '部门信息',
			'search_key' => '',
			'add_button' => 1,
			'del_button' => 1,
			'search_button' => 1,
			'check_all' => 1,
			'list_row' => 20,
			'addon' => 'OaSystem'
	];
	
	// 列表定义
	public $list_grid = [
			'dept_no' => [
					'title' => '部门编号',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 1
			],
			'name' => [
					'title' => '部门名称',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'short_name' => [
					'title' => '部门短名',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'dept_grade_id' => [
					'title' => '部门等级',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'pid' => [
					'title' => '父级部门id',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'remark' => [
					'title' => '备注',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'urls' => [
					'title' => '操作',
					'come_from' => 1,
					'width' => '',
					'is_sort' => 0,
					'href' => [
							'0' => [
									'title' => '编辑',
									'url' => '[EDIT]'
							],
							'1' => [
									'title' => '删除',
									'url' => '[DELETE]'
							]
					]
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
			'pid' => [
					'title' => '父级部门id',
					'type' => 'string',
					'field' => 'int(10) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'dept_no' => [
					'title' => '部门编号',
					'type' => 'string',
					'field' => 'varchar(200) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'dept_grade_id' => [
					'title' => '部门等级',
					'type' => 'string',
					'field' => 'int(10) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'name' => [
					'title' => '部门名称',
					'type' => 'string',
					'field' => 'varchar(200) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'short_name' => [
					'title' => '部门短名',
					'type' => 'string',
					'field' => 'varchar(100) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'sort' => [
					'title' => '排序编号',
					'type' => 'string',
					'field' => 'int(10) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'remark' => [
					'title' => '备注',
					'type' => 'string',
					'field' => 'varchar(255) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			]
	];
}	