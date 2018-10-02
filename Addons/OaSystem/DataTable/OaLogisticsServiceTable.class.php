<?php
/**
 * OaLogisticsService数据模型
 */
class OaLogisticsServiceTable {
	// 数据表模型配置
	public $config = [
			'name' => 'oa_logistics_service',
			'title' => '后勤商品列表',
			'search_key' => '',
			'add_button' => 1,
			'del_button' => 1,
			'search_button' => 1,
			'check_all' => 1,
			'list_row' => 0,
			'addon' => 'OaSystem'
	];
	
	// 列表定义
	public $list_grid = [
			'name' => [
					'title' => '名称',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'pic' => [
					'title' => '商品图片',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'description' => [
					'title' => '描述',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'price' => [
					'title' => '价格',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			]
	];
	
	// 字段定义
	public $fields = [
			'appid' => [
					'title' => '小程序appid',
					'field' => 'int(10) NOT NULL',
					'type' => 'string',
					'is_must' => 1,
					'placeholder' => '请输入内容'
			],
			'type' => [
					'title' => '商品类型',
					'field' => 'char(50) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'name' => [
					'title' => '名称',
					'field' => 'varchar(100) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'pic' => [
					'title' => '商品图片',
					'field' => 'int(10) unsigned NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'description' => [
					'title' => '描述',
					'field' => 'varchar(255) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'comment' => [
					'title' => '内容',
					'field' => 'text NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'isAcitve' => [
					'title' => '是否有效',
					'field' => 'tinyint(2) NOT NULL',
					'type' => 'string',
					'is_must' => 1,
					'value' => 1,
					'placeholder' => '请输入内容'
			],
			'price' => [
					'title' => '价格',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			]
	];
}	