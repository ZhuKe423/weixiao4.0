<?php
/**
 * WxyStudentCare数据模型
 */
class WxyStudentCareTable {
	// 数据表模型配置
	public $config = [
			'name' => 'wxy_student_care',
			'title' => '学员绑定',
			'search_key' => '',
			'add_button' => 1,
			'del_button' => 1,
			'search_button' => 1,
			'check_all' => 1,
			'list_row' => 20,
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
			'uid' => [
					'title' => '用户ID',
					'type' => 'num',
					'field' => 'int(11) NULL',
					'remark' => '用户ID',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'openid' => [
					'title' => 'Openid',
					'type' => 'string',
					'field' => 'varchar(200) NULL',
					'remark' => 'Openid',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'is_init' => [
					'title' => '是否申请',
					'type' => 'select',
					'field' => 'char(50) NULL',
					'extra' => '已申请
未申请',
					'remark' => '是否申请',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'is_audit' => [
					'title' => '是否批准',
					'type' => 'select',
					'field' => 'char(50) NULL',
					'extra' => '批准
未批准',
					'remark' => '是否批准',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'timestamp' => [
					'title' => '时标',
					'type' => 'date',
					'field' => 'int(10) NULL',
					'remark' => '时标',
					'is_show' => 1,
					'is_must' => 0,
					'auto_type' => 'function',
					'auto_rule' => 'date',
					'auto_time' => 3
			]
	];
}	