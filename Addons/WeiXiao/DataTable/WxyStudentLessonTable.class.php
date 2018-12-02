<?php
/**
 * WxyStudentLesson数据模型
 */
class WxyStudentLessonTable {
	// 数据表模型配置
	public $config = [
			'name' => 'wxy_student_lesson',
			'title' => '学生课时',
			'search_key' => '',
			'add_button' => 1,
			'del_button' => 1,
			'search_button' => 1,
			'check_all' => 1,
			'list_row' => '',
			'addon' => 'WeiXiao'
	];
	
	// 列表定义
	public $list_grid = [ ];
	
	// 字段定义
	public $fields = [
			'token' => [
					'title' => '机构Token',
					'type' => 'string',
					'field' => 'varchar(200) NULL',
					'remark' => '机构Token',
					'is_show' => 4,
					'auto_type' => 'function',
					'auto_rule' => 'get_token',
					'auto_time' => 3,
					'placeholder' => '请输入内容'
			],
			'courseid' => [
					'title' => '课程ID',
					'type' => 'num',
					'field' => 'int(10) NULL',
					'remark' => '课程ID',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'lesson_id' => [
					'title' => '课时ID',
					'type' => 'num',
					'field' => 'int(11) NULL',
					'remark' => '课时ID',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'sid' => [
					'title' => '学生ID',
					'type' => 'num',
					'field' => 'int(11) NULL',
					'remark' => '学生ID',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'studentno' => [
					'title' => '学号',
					'type' => 'string',
					'field' => 'varchar(20) NULL',
					'remark' => '学号',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'status' => [
					'title' => '课时状态',
					'type' => 'select',
					'field' => 'char(50) NULL',
					'extra' => '正常
调课',
					'remark' => '课时状态',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'bat' => [
					'title' => '课时批次',
					'type' => 'num',
					'field' => 'int(10) NULL',
					'remark' => '课时批次',
					'is_show' => 1,
					'is_must' => 0
			]
	];
}	