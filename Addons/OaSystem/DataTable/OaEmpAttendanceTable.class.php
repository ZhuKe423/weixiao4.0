<?php
/**
 * OaEmpAttendance数据模型
 */
class OaEmpAttendanceTable {
	// 数据表模型配置
	public $config = [
			'name' => 'oa_emp_attendance',
			'title' => '考勤',
			'search_key' => '',
			'add_button' => 1,
			'del_button' => 1,
			'search_button' => 1,
			'check_all' => 1,
			'list_row' => 0,
			'addon' => 'OaSystem'
	];
	
	// 列表定义
	public $list_grid = [ ];
	
	// 字段定义
	public $fields = [
			'appid' => [
					'title' => '小程序appid',
					'field' => 'varchar(255) NOT NULL',
					'type' => 'string',
					'is_must' => 1
			],
			'emp_no' => [
					'title' => '员工编号',
					'field' => 'varchar(255) NULL',
					'type' => 'string'
			],
			'emp_id' => [
					'title' => 'OAuserId',
					'field' => 'int(10) NOT NULL',
					'type' => 'string',
					'is_must' => 1
			],
			'arrived' => [
					'title' => '上班',
					'field' => 'int(10) NULL',
					'type' => 'string'
			],
			'leave' => [
					'title' => '下班',
					'field' => 'int(10) NULL',
					'type' => 'string'
			],
			'remark' => [
					'title' => '备注',
					'field' => 'varchar(255) NULL',
					'type' => 'string'
			],
			'status' => [
					'title' => '状态',
					'field' => 'varchar(50) NULL',
					'type' => 'string'
			],
			'location' => [
					'title' => '打卡位置',
					'field' => 'varchar(255) NULL',
					'type' => 'string'
			]
	];
}	