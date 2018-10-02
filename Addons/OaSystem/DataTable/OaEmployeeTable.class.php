<?php
/**
 * OaUser数据模型
 */
class OaEmployeeTable {
	// 数据表模型配置
	public $config = [
			'name' => 'oa_user',
			'title' => 'OA员工信息表',
			'search_key' => '',
			'add_button' => 1,
			'del_button' => 1,
			'search_button' => 1,
			'check_all' => 1,
			'list_row' => 20,
			'addon' => 'OaSystem'
	];
	
	// 列表定义
	public $list_grid = [
			'pic' => [
					'title' => '头像',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'pic',
					'function' => '',
					'href' => [ ]
			],
			'emp_no' => [
					'title' => '员工编号',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 1,
					'name' => 'emp_no',
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
			'sex' => [
					'title' => '性别',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'sex',
					'function' => '',
					'href' => [ ]
			],
			'birthday' => [
					'title' => '出生日期',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'birthday',
					'function' => '',
					'href' => [ ]
			],
			'dept_id' => [
					'title' => '部门ID',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'dept_id',
					'function' => '',
					'href' => [ ]
			],
			'duty' => [
					'title' => '职务',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'duty',
					'function' => '',
					'href' => [ ]
			],
			'office_tel' => [
					'title' => '办公室电话',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'office_tel',
					'function' => '',
					'href' => [ ]
			],
			'mobile_list' => [
					'title' => '移动电话',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'mobile',
					'function' => '',
					'href' => [ ]
			],
			'last_login_ip' => [
					'title' => '上次登录IP',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'last_login_ip',
					'function' => '',
					'href' => [ ]
			]
	];
	
	// 字段定义
	public $fields = [
			'appid' => [
					'title' => '小程序应用id',
					'type' => 'string',
					'field' => 'varchar(255) NOT NULL',
					'is_show' => 1,
					'is_must' => 1,
					'placeholder' => '请输入内容'
			],
			'userid' => [
					'title' => 'WephpUserid',
					'field' => 'int(10) NOT NULL',
					'type' => 'string',
					'is_must' => 1,
					'placeholder' => '请输入内容'
			],
			'emp_no' => [
					'title' => '员工编号',
					'type' => 'string',
					'field' => 'varchar(255) NOT NULL',
					'is_show' => 1,
					'is_must' => 1,
					'placeholder' => '请输入内容'
			],
			'name' => [
					'title' => '姓名',
					'type' => 'string',
					'field' => 'varchar(255) NULL',
					'is_show' => 1,
					'is_must' => 0
			],
			'pinyin' => [
					'title' => '姓名拼音',
					'field' => 'varchar(255) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'password' => [
					'title' => '密码',
					'field' => 'varchar(255) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'dept_id' => [
					'title' => '部门ID',
					'field' => 'int(10) NOT NULL',
					'type' => 'string',
					'is_must' => 1,
					'placeholder' => '请输入内容'
			],
			'sex' => [
					'title' => '性别',
					'field' => 'varchar(20) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'birthday' => [
					'title' => '出生日期',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'last_login_ip' => [
					'title' => '上次登录IP',
					'field' => 'varchar(100) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'login_count' => [
					'title' => '登录次数',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'pic' => [
					'title' => '头像',
					'type' => 'picture',
					'field' => 'varchar(255) NULL',
					'placeholder' => '请输入内容'
			],
			'duty' => [
					'title' => '职务',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'office_tel' => [
					'title' => '办公室电话',
					'field' => 'varchar(255) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'mobile_list' => [
					'title' => '移动电话',
					'field' => 'varchar(100) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'openid_list' => [
					'title' => 'wxOpenid',
					'field' => 'varchar(200) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'unionid_list' => [
					'title' => '微信unionid',
					'field' => 'varchar(200) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'create_time' => [
					'title' => '创建时间',
					'field' => 'int(10) NOT NULL',
					'type' => 'string',
					'is_must' => 1,
					'placeholder' => '请输入内容'
			],
			'update_time' => [
					'title' => '更新时间',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'isleaved' => [
					'title' => '是否离职',
					'field' => 'tinyint(2) NOT NULL',
					'type' => 'string',
					'is_must' => 1,
					'placeholder' => '请输入内容'
			]
	];
}	