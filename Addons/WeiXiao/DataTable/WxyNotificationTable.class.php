<?php
/**
 * WxyNotification数据模型
 */
class WxyNotificationTable {
	// 数据表模型配置
	public $config = [
			'name' => 'wxy_notification',
			'title' => '消息通知',
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
					'title' => 'Token',
					'type' => 'string',
					'field' => 'varchar(200) NULL',
					'remark' => '机构',
					'auto_type' => 'function',
					'auto_rule' => 'get_token',
					'auto_time' => 3,
					'placeholder' => '请输入内容'
			],
			'title' => [
					'title' => '消息标题',
					'type' => 'string',
					'field' => 'varchar(200) NULL',
					'remark' => '消息标题',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'message' => [
					'title' => '消息体',
					'type' => 'string',
					'field' => 'varchar(255) NULL',
					'remark' => '消息体（JSON数组）',
					'placeholder' => '请输入内容'
			],
			'url' => [
					'title' => '链接',
					'type' => 'textarea',
					'field' => 'Text NULL',
					'remark' => '消息链接',
					'is_show' => 0,
					'is_must' => 0
			],
			'timestamp' => [
					'title' => '时间',
					'type' => 'date',
					'field' => 'int(10) NULL',
					'remark' => '时间',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			]
	];
}	