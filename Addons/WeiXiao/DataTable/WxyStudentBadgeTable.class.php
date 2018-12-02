<?php
/**
 * WxyStudentBadge数据模型
 */
class WxyStudentBadgeTable {
	// 数据表模型配置
	public $config = [
			'name' => 'wxy_student_badge',
			'title' => '考勤卡表',
			'search_key' => '',
			'add_button' => 1,
			'del_button' => 1,
			'search_button' => 1,
			'check_all' => 1,
			'list_row' => 10,
			'addon' => 'WeiXiao'
	];
	
	// 列表定义
	public $list_grid = [
			'studentno' => [
					'title' => '学号',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'name' => [
					'title' => '姓名',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'type' => [
					'title' => '卡类型',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'serial_no' => [
					'title' => '序列号',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'cardno' => [
					'title' => 'Rfid号',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'finger' => [
					'title' => '指纹模型',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			]
	];
	
	// 字段定义
	public $fields = [
			'token' => [
					'title' => '机构Token',
					'field' => 'varchar(100) NOT NULL',
					'type' => 'string',
					'is_must' => 1,
					'placeholder' => '请输入内容'
			],
			'updatetime' => [
					'title' => '更新时间',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'cardno' => [
					'title' => 'Rfid号',
					'field' => 'varchar(255) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'studentno' => [
					'title' => '学号',
					'type' => 'string',
					'field' => 'varchar(20) NOT NULL',
					'is_must' => 1,
					'placeholder' => '请输入内容'
			],
			'name' => [
					'title' => '姓名',
					'field' => 'varchar(50) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'serial_no' => [
					'title' => '序列号',
					'field' => 'varchar(255) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'type' => [
					'title' => '卡类型',
					'type' => 'num',
					'field' => 'varchar(20) NOT NULL',
					'value' => 1,
					'remark' => '1:射频卡， 2: 指纹识别， 3:面部识别',
					'is_must' => 1,
					'placeholder' => '请输入内容'
			],
			'finger' => [
					'title' => '指纹模型',
					'type' => 'textarea',
					'field' => 'text NULL',
					'remark' => '[{\\\\\\\\\"fingerId\\\\\\\\\": 0, \\\\\\\\\"fingerModelSize\\\\\\\\\": 1592, \\\\\\\\\"fingerModel\\\\\\\\\": \\\\\\\\\"xxxx\\\\\\\\\"},]',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			]
	];
}	