<?php
/**
 * WxyModelImport数据模型
 */
class WxyModelImportTable {
	// 数据表模型配置
	public $config = [
			'name' => 'wxy_model_import',
			'title' => '模型导入记录',
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
					'title' => 'token',
					'type' => 'string',
					'field' => 'varchar(200) NULL',
					'remark' => '机构Token',
					'placeholder' => '请输入内容'
			],
			'uid' => [
					'title' => '用户ID',
					'type' => 'num',
					'field' => 'int(11) NULL',
					'remark' => '操作用户ID',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'file' => [
					'title' => '文件ID',
					'type' => 'num',
					'field' => 'int(11) NULL',
					'remark' => '文件ID',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'date' => [
					'title' => '导入日期',
					'type' => 'string',
					'field' => 'varchar(100) NULL',
					'remark' => '导入日期',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'comment' => [
					'title' => '描述',
					'type' => 'string',
					'field' => 'varchar(200) NULL',
					'remark' => '描述',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'model_id' => [
					'title' => '模型ID',
					'type' => 'num',
					'field' => 'int(10) NULL',
					'remark' => '模型ID',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'model_name' => [
					'title' => '模型名称',
					'type' => 'string',
					'field' => 'varchar(200) NULL',
					'remark' => '模型名称',
					'is_show' => 1,
					'is_must' => 0
			]
	];
}	