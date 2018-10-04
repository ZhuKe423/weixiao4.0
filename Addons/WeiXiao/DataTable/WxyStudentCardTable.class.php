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
	public $list_grid = [ ];
	
	// 字段定义
	public $fields = [
			'token' => [
					'title' => '机构Token',
					'type' => 'string',
					'field' => 'varchar(100) NOT NULL',
					'remark' => '机构Token',
					'is_show' => 0,
					'is_must' => 1
			],
			'studentno' => [
					'title' => '学号',
					'field' => 'varchar(20) NULL',
					'type' => 'string',
					'remark' => '学号',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'name' => [
					'title' => '姓名',
					'field' => 'varchar(50) NULL',
					'type' => 'string',
					'remark' => '姓名',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'gender' => [
					'title' => '性别',
					'field' => 'tinyint(2) DEFAULT \"1\"',
					'type' => 'string',
					'remark' => '性别',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'school' => [
					'title' => '学校',
					'field' => 'varchar(100) NULL',
					'type' => 'string',
					'remark' => '学校',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'ent_year' => [
					'title' => '入学年份',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'remark' => '入学年份',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'class_id' => [
					'title' => '班号',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'remark' => '班号',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'grade' => [
					'title' => '年级',
					'field' => 'varchar(20) NULL',
					'type' => 'string',
					'remark' => '年级',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'phone' => [
					'title' => '联系电话',
					'field' => 'varchar(40) NULL',
					'type' => 'string',
					'remark' => '联系电话',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'phone_bck' => [
					'title' => '备用电话',
					'field' => 'varchar(40) NULL',
					'type' => 'string',
					'remark' => '备用电话',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'enrolled' => [
					'title' => '是否就读',
					'field' => 'varchar(10) NULL',
					'type' => 'string',
					'remark' => '缴费就读',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'lesson_done' => [
					'title' => '已学课时',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'remark' => '已学课时数',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'oid' => [
					'title' => '机构ID',
					'field' => 'varchar(100) NULL',
					'type' => 'string',
					'remark' => '机构ID',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'sid' => [
					'title' => '学生标识',
					'type' => 'string',
					'field' => 'int(11) NULL',
					'remark' => '学生标识',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'uid' => [
					'title' => '用户ID',
					'type' => 'string',
					'field' => 'int(11) NULL',
					'remark' => '用户ID',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'timestamp' => [
					'title' => '时标',
					'type' => 'string',
					'field' => 'datetime NULL',
					'remark' => '创建时标',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			]
	];
}	