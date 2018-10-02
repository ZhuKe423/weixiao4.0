<?php
/**
 * WxyCourse数据模型
 */
class WxyCourseTable {
	// 数据表模型配置
	public $config = [
			'name' => 'wxy_course',
			'title' => '课程',
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
					'field' => 'varchar(100) NULL',
					'remark' => '机构Token',
					'placeholder' => '请输入内容'
			],
			'name' => [
					'title' => '课程名称',
					'type' => 'string',
					'field' => 'varchar(200) NULL',
					'remark' => '课程名称',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'cover' => [
					'title' => '封面图片',
					'type' => 'string',
					'field' => 'int(10) unsigned NULL',
					'remark' => '封面图片',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'teacher' => [
					'title' => '任课教师',
					'type' => 'string',
					'field' => 'varchar(100) NULL',
					'remark' => '任课教师',
					'is_show' => 1,
					'is_must' => 0
			],
			'intro' => [
					'title' => '课程介绍',
					'type' => 'string',
					'field' => 'text NULL',
					'remark' => '课程介绍',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'sdate' => [
					'title' => '开始日期',
					'type' => 'string',
					'field' => 'varchar(20) NULL',
					'remark' => '开始日期',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'edate' => [
					'title' => '结束日期',
					'type' => 'string',
					'field' => 'varchar(20) NULL',
					'remark' => '结束日期',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'length' => [
					'title' => '课时数',
					'type' => 'string',
					'field' => 'int(10) NULL',
					'remark' => '课时数',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'timestamp' => [
					'title' => '录入时间',
					'type' => 'string',
					'field' => 'datetime NULL',
					'remark' => '录入时间',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'site' => [
					'title' => '校区',
					'type' => 'string',
					'field' => 'varchar(50) NULL',
					'remark' => '校区',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			]
	];
}	