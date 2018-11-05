<?php
/**
 * WxySlideshow数据模型
 */
class WxySlideshowTable {
	// 数据表模型配置
	public $config = [
			'name' => 'wxy_slideshow',
			'title' => '微校首页用幻灯片',
			'search_key' => 'title',
			'add_button' => 1,
			'del_button' => 1,
			'search_button' => 1,
			'check_all' => 1,
			'list_row' => 20,
			'addon' => 'WeiXiao'
	];
	
	// 列表定义
	public $list_grid = [
			'title' => [
					'title' => '标题',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'title',
					'function' => '',
					'href' => [ ]
			],
			'img' => [
					'title' => '图片',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'img',
					'function' => '',
					'href' => [ ]
			],
			'url' => [
					'title' => '链接地址',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'url',
					'function' => '',
					'href' => [ ]
			],
			'is_show' => [
					'title' => '是否显示',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'is_show',
					'function' => '',
					'href' => [ ]
			],
			'sort' => [
					'title' => '排序',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0,
					'name' => 'sort',
					'function' => '',
					'href' => [ ]
			],
			'urls' => [
					'title' => '标题',
					'come_from' => 1,
					'width' => '',
					'is_sort' => 0,
					'href' => [
							'0' => [
									'title' => '编辑',
									'url' => '[EDIT]&module_id=[pid]'
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
			'title' => [
					'title' => '标题',
					'type' => 'string',
					'field' => 'varchar(255) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'img' => [
					'title' => '图片',
					'type' => 'picture',
					'field' => 'int(10) unsigned NOT NULL',
					'is_show' => 1,
					'is_must' => 1,
					'placeholder' => '请输入内容'
			],
			'url' => [
					'title' => '链接地址',
					'type' => 'string',
					'field' => 'varchar(255) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'is_show' => [
					'title' => '是否显示',
					'type' => 'bool',
					'field' => 'tinyint(2) NULL',
					'extra' => '0:不显示
1:显示',
					'value' => 1,
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'sort' => [
					'title' => '排序',
					'type' => 'num',
					'field' => 'int(10) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'token' => [
					'title' => 'Token',
					'type' => 'string',
					'field' => 'varchar(200) NULL',
					'auto_type' => 'function',
					'auto_rule' => 'get_token',
					'auto_time' => 3,
					'placeholder' => '请输入内容'
			],
			'cate_id' => [
					'title' => '所属目录',
					'type' => 'string',
					'field' => 'varchar(120) NULL',
					'value' => 0,
					'is_show' => 0,
					'is_must' => 0
			]
	];
}	