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
					'field' => 'varchar(100) NULL',
					'type' => 'string',
                    'remark' => '机构Token',
                    'is_show' => 0,
                    'placeholder' => '请输入内容'
			],
			'name' => [
					'title' => '课程名称',
					'field' => 'varchar(200) NULL',
					'type' => 'string',
                    'remark' => '课程名称',
                    'is_show' => 1,
                    'placeholder' => '请输入内容'
			],
			'cover' => [
					'title' => '封面图片',
					'field' => 'int(10) unsigned NULL',
					'type' => 'string',
                    'remark' => '封面图片',
                    'is_show' => 1,
                    'placeholder' => '请输入内容'
			],
			'teacher' => [
					'title' => '任课教师',
					'field' => 'varchar(100) NULL',
					'type' => 'string',
                    'remark' => '任课教师',
                    'is_show' => 1,
                    'placeholder' => '请输入内容'
			],
			'intro' => [
					'title' => '课程介绍',
					'field' => 'text NULL',
					'type' => 'string',
                    'remark' => '课程介绍',
                    'is_show' => 1,
                    'placeholder' => '请输入内容'
			],
			'sdate' => [
					'title' => '开始日期',
					'field' => 'varchar(20) NULL',
					'type' => 'string',
                    'remark' => '开始日期',
                    'is_show' => 1,
                    'placeholder' => '请输入内容'
			],
			'edate' => [
					'title' => '结束日期',
					'field' => 'varchar(20) NULL',
					'type' => 'string',
                    'remark' => '结束日期',
                    'is_show' => 1,
                    'placeholder' => '请输入内容'
			],
			'length' => [
					'title' => '课时数',
					'field' => 'int(10) NULL',
					'type' => 'string',
                    'remark' => '课时数',
                    'is_show' => 1,
                    'placeholder' => '请输入内容'
			],
			'timestamp' => [
					'title' => '录入时间',
					'field' => 'datetime NULL',
					'type' => 'string',
                    'remark' => '录入时间',
                    'is_show' => 1,
                    'placeholder' => '请输入内容'
			],
			'site' => [
					'title' => '校区',
					'field' => 'varchar(100) NULL',
					'type' => 'string',
                    'remark' => '校区',
                    'is_show' => 1,
                    'placeholder' => '请输入内容'
			],
			'subject' => [
					'title' => '科目',
					'type' => 'string',
					'field' => 'varchar(60) NULL',
					'remark' => '科目',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'grade' => [
					'title' => '年级',
					'type' => 'string',
					'field' => 'varchar(60) NULL',
					'remark' => '年级',
					'is_show' => 1,
					'is_must' => 0
			]
	];
}	