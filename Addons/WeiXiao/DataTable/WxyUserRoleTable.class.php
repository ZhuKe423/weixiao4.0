<?php
/**
 * WxyUserRole数据模型
 */
class WxyUserRoleTable {
	// 数据表模型配置
	public $config = [
			'name' => 'wxy_user_role',
			'title' => '微信用户角色表',
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
			'phone' => [
					'title' => '手机号',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'm_role' => [
					'title' => '微信端用户角色',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'manger' => [
					'title' => '管理员',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'urls' => [
					'title' => '机构Token',
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
					'remark' => '机构Token',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'uid' => [
					'title' => '用户ID',
					'type' => 'string',
					'field' => 'int(11) NULL',
					'remark' => '用户ID',
					'placeholder' => '请输入内容'
			],
			'openid' => [
					'title' => '用户openid',
					'type' => 'string',
					'field' => 'varchar(100) NULL',
					'remark' => '用户openid',
					'placeholder' => '请输入内容'
			],
			'm_role' => [
					'title' => '微信端用户角色',
					'type' => 'select',
					'field' => 'varchar(100) NULL',
					'extra' => '微信教务端
微信教师端',
					'remark' => '微角色：教务，普通',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'manger' => [
					'title' => '管理员',
					'type' => 'radio',
					'field' => 'tinyint(2) NULL',
					'extra' => '教务管理
教师管理
全面管理',
					'remark' => '管理员',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'timestamp' => [
					'title' => '时标',
					'type' => 'string',
					'field' => 'datetime NULL',
					'remark' => '创建时标',
					'placeholder' => '请输入内容'
			],
			'phone' => [
					'title' => '手机号',
					'type' => 'string',
					'field' => 'varchar(100) NULL',
					'remark' => '手机号码',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			]
	];
}	