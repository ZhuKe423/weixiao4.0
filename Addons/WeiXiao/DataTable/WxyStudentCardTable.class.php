<?php
/**
 * WxyStudentCard数据模型
 */
class WxyStudentCardTable {
	// 数据表模型配置
	public $config = [
			'name' => 'wxy_student_card',
			'title' => '学员卡',
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
					'is_sort' => 1,
					'name' => 'studentno',
					'function' => '',
					'href' => [ ]
			],
			'name' => [
					'title' => '姓名',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'name',
					'function' => '',
					'href' => [ ]
			],
			'grade' => [
					'title' => '年级',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'grade',
					'function' => '',
					'href' => [ ]
			],
			'phone' => [
					'title' => '联系电话',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'phone',
					'function' => '',
					'href' => [ ]
			],
			'phone_bck' => [
					'title' => '备用电话',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'phone_bck',
					'function' => '',
					'href' => [ ]
			],
			'pay_status' => [
					'title' => '缴费情况',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'pay_status',
					'function' => '',
					'href' => [ ]
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
					],
					'name' => 'urls',
					'function' => ''
			]
	];
	
	// 字段定义
	public $fields = [
			'token' => [
					'title' => '机构Token',
					'type' => 'string',
					'field' => 'varchar(100) NULL',
					'is_show' => 0,
					'is_must' => 0,
					'auto_type' => 'function',
					'auto_rule' => 'get_token',
					'auto_time' => 3
			],
			'studentno' => [
					'title' => '学号',
					'type' => 'string',
					'field' => 'varchar(20) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'name' => [
					'title' => '姓名',
					'type' => 'string',
					'field' => 'varchar(50) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'gender' => [
					'title' => '性别',
					'type' => 'radio',
					'field' => 'tinyint(2) NULL',
					'extra' => '男
女',
					'value' => 1,
					'placeholder' => '请输入内容'
			],
			'school' => [
					'title' => '学校',
					'type' => 'string',
					'field' => 'varchar(100) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'ent_year' => [
					'title' => '入学年份',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'class_id' => [
					'title' => '班号',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'grade' => [
					'title' => '年级',
					'type' => 'select',
					'field' => 'varchar(20) NULL',
					'extra' => '7:初一
8:初二
9:初三
10:高一
11:高二
12:高三',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'phone' => [
					'title' => '联系电话',
					'field' => 'varchar(40) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'phone_bck' => [
					'title' => '备用电话',
					'field' => 'varchar(40) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'enrolled' => [
					'title' => '是否就读',
					'field' => 'varchar(10) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'lesson_done' => [
					'title' => '已学课时',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'oid' => [
					'title' => '机构ID',
					'field' => 'varchar(100) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'sid' => [
					'title' => '学生标识',
					'field' => 'int(11) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'uid' => [
					'title' => '用户ID',
					'field' => 'int(11) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'timestamp' => [
					'title' => '时标',
					'field' => 'datetime NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'pay_status' => [
					'title' => '缴费情况',
					'type' => 'radio',
					'field' => 'varchar(100) NULL',
					'extra' => '已缴
未缴
部分未缴',
					'remark' => '缴费情况（已缴、未缴）',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			]
	];
}	