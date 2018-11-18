<?php
/**
 * WxyCourse数据模型
 */
class WxyCourseTable {
	// 数据表模型配置
	public $config = [
			'name' => 'wxy_course',
			'title' => '课程',
			'search_key' => 'name',
			'add_button' => 1,
			'del_button' => 1,
			'search_button' => 1,
			'check_all' => 1,
			'list_row' => 10,
			'addon' => 'WeiXiao'
	];
	
	// 列表定义
	public $list_grid = [
			'id' => [
					'title' => 'ID主键',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'name' => [
					'title' => '课程名称',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'site' => [
					'title' => '校区',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'subject' => [
					'title' => '科目',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'teacher' => [
					'title' => '任课教师',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'grade' => [
					'title' => '年级',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'length' => [
					'title' => '课时数',
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
							],
							'2' => [
									'title' => '排课',
									'url' => 'lessonList&cid=[id]'
							],
							'3' => [
									'title' => '精品',
									'url' => 'set_top&cid=[id]'
							],
							'4' => [
									'title' => '导入',
									'url' => 'courseStudentsImport&cid=[id]'
							]
					]
			]
	];
	
	// 字段定义
	public $fields = [
			'token' => [
					'title' => '机构Token',
					'type' => 'string',
					'field' => 'varchar(100) NULL',
					'auto_type' => 'function',
					'auto_rule' => 'get_token',
					'auto_time' => 3,
					'placeholder' => '请输入内容'
			],
			'name' => [
					'title' => '课程名称',
					'type' => 'string',
					'field' => 'varchar(200) NULL',
					'value' => 'NULL',
					'remark' => '课程名称',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'cover' => [
					'title' => '封面图片',
					'type' => 'picture',
					'field' => 'int(10) unsigned NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'teacher' => [
					'title' => '任课教师',
					'type' => 'string',
					'field' => 'varchar(100) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'intro' => [
					'title' => '课程介绍',
					'type' => 'editor',
					'field' => 'text NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'sdate' => [
					'title' => '开始日期',
					'type' => 'date',
					'field' => 'int(10) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'edate' => [
					'title' => '结束日期',
					'type' => 'date',
					'field' => 'int(10) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'length' => [
					'title' => '课时数',
					'type' => 'string',
					'field' => 'int(10) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'top' => [
					'title' => '精品',
					'type' => 'select',
					'field' => 'char(50) NULL',
					'extra' => '普通
精品
特等',
					'remark' => '是否设置课程为精品课程',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'timestamp' => [
					'title' => '录入时间',
					'type' => 'date',
					'field' => 'int(10) NULL',
					'auto_type' => 'function',
					'auto_rule' => 'time',
					'auto_time' => 3,
					'placeholder' => '请输入内容'
			],
			'site' => [
					'title' => '校区',
					'type' => 'string',
					'field' => 'varchar(100) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'subject' => [
					'title' => '科目',
					'type' => 'radio',
					'field' => 'varchar(60) NULL',
					'extra' => '1:数学
2:英语
3:语文
4:物理
5:化学
6:生物',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'grade' => [
					'title' => '年级',
					'type' => 'radio',
					'field' => 'varchar(60) NULL',
					'extra' => '7:初一
8:初二
9:初三
10:高一
11:高二
12:高三',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'status' => [
					'title' => '状态',
					'type' => 'select',
					'field' => 'char(50) NULL',
					'extra' => '即将开课
进行中
结束',
					'remark' => '课程状态',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			]
	];
}	