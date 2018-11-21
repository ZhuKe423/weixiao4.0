<?php
/**
 * WxyStudentCourse数据模型
 */
class WxyStudentCourseTable {
	// 数据表模型配置
	public $config = [
			'name' => 'wxy_student_course',
			'title' => '学员定课表',
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
			'courseid' => [
					'title' => '课程ID',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 1
			],
			'studentno' => [
					'title' => '学号',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'sid' => [
					'title' => '学生id',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 1
			],
			'bat_no' => [
					'title' => '排课批次',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'status' => [
					'title' => '状态',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'opcode' => [
					'title' => '操作员',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			]
	];
	
	// 字段定义
	public $fields = [
			'token' => [
					'title' => '机构Token',
					'type' => 'string',
					'field' => 'varchar(100) NOT NULL',
					'remark' => '机构Token',
					'is_must' => 1,
					'placeholder' => '请输入内容'
			],
			'studentno' => [
					'title' => '学号',
					'field' => 'varchar(20) NULL',
					'type' => 'string',
					'remark' => '学号',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'courseid' => [
					'title' => '课程ID',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'remark' => '课程ID',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'bat_no' => [
					'title' => '排课批次',
					'type' => 'num',
					'field' => 'int(6) NULL',
					'remark' => '课程批次',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'status' => [
					'title' => '状态',
					'type' => 'select',
					'field' => 'tinyint(3) NULL',
					'extra' => '正常
临时',
					'remark' => '状态（正常，临时）',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'opcode' => [
					'title' => '操作员',
					'type' => 'select',
					'field' => 'TINYINT(3) NULL',
					'extra' => '教务
家长',
					'remark' => '操作员（教务、家长）',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'timestamp' => [
					'title' => '时标',
					'type' => 'num',
					'field' => 'int(10) NULL',
					'remark' => '创建时标',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'sid' => [
					'title' => '学生id',
					'type' => 'num',
					'field' => 'int(10) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			]
	];
}	