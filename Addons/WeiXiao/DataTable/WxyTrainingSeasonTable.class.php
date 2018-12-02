<?php
/**
 * WxyTrainingSeason数据模型
 */
class WxyTrainingSeasonTable {
	// 数据表模型配置
	public $config = [
			'name' => 'wxy_training_season',
			'title' => '培训季',
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
					'title' => '机构Token',
					'type' => 'string',
					'field' => 'varchar(200) NULL',
					'remark' => '机构Token',
					'auto_type' => 'function',
					'auto_rule' => 'get_token',
					'auto_time' => 3,
					'placeholder' => '请输入内容'
			],
			'seaon_name' => [
					'title' => '培训季名称',
					'type' => 'string',
					'field' => 'varchar(200) NULL',
					'remark' => '培训季名称',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'timestamp' => [
					'title' => '录入时间',
					'type' => 'date',
					'field' => 'int(10) NULL',
					'remark' => '录入时间',
					'is_show' => 1,
					'is_must' => 0
			]
	];
}	