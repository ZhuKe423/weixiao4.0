<?php
/**
 * WxyCourseLesson数据模型
 */
class WxyCourseLessonTable {
	// 数据表模型配置
	public $config = [
			'name' => 'wxy_course_lesson',
			'title' => '排课表',
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
			'sequence' => [
					'title' => '课程序号',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'sequence',
					'function' => '',
					'href' => [ ]
			],
			'classdate' => [
					'title' => '上课时间',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'classdate',
					'function' => '',
					'href' => [ ]
			],
			'classlen' => [
					'title' => '课时长度',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'classlen',
					'function' => '',
					'href' => [ ]
			],
			'site' => [
					'title' => '校区',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'site',
					'function' => '',
					'href' => [ ]
			],
			'room' => [
					'title' => '教室',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'room',
					'function' => '',
					'href' => [ ]
			],
			'courseid' => [
					'title' => '课程ID',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'courseid',
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
									'url' => '[EDIT]&id=[id]'
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
					'remark' => '机构Token',
					'placeholder' => '请输入内容'
			],
			'courseid' => [
					'title' => '课程ID',
					'type' => 'string',
					'field' => 'int(10) NOT NULL',
					'remark' => '课程ID',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'bat' => [
					'title' => '课程批次',
					'type' => 'num',
					'field' => 'int(10) NULL',
					'remark' => '课程批次（一个课程可能在不同时间进行多个批次）',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'sequence' => [
					'title' => '课程序号',
					'type' => 'string',
					'field' => 'int(10) NULL',
					'remark' => '课程序号',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'classdate' => [
					'title' => '上课时间',
					'type' => 'string',
					'field' => 'datetime DEFAULT NULL',
					'remark' => '上课时间',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'classlen' => [
					'title' => '课时长度',
					'type' => 'string',
					'field' => 'int(8) DEFAULT NULL',
					'remark' => '课时长度',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'check_pos' => [
					'title' => '机位',
					'field' => 'varchar(50) NULL',
					'type' => 'string',
					'remark' => '考勤机位置',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'site' => [
					'title' => '校区',
					'type' => 'string',
					'field' => 'varchar(50) DEFAULT NULL',
					'remark' => '校区',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'room' => [
					'title' => '教室',
					'type' => 'string',
					'field' => 'varchar(50) DEFAULT NULL',
					'remark' => '教室',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			]
	];
}	