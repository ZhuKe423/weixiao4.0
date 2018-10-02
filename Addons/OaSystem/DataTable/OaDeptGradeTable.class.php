<?php
/**
 * OaDeptGrade数据模型
 */
class OaDeptGradeTable {
	// 数据表模型配置
	public $config = [
			'name' => 'oa_dept_grade',
			'title' => '部门等级',
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
			'grade_no' => [
					'title' => '等级编号',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 1
			],
			'name' => [
					'title' => '等级名称',
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
					'field' => 'varchar(200) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'grade_no' => [
					'title' => '等级编号',
					'type' => 'string',
					'field' => 'varchar(100) NOT NULL',
					'is_show' => 1,
					'is_must' => 1,
					'placeholder' => '请输入内容'
			],
			'name' => [
					'title' => '等级名称',
					'type' => 'string',
					'field' => 'varchar(200) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'sort' => [
					'title' => '排序',
					'field' => 'int(10) NULL',
					'type' => 'string',
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