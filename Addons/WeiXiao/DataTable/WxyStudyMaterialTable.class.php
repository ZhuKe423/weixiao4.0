<?php
/**
 * WxyStudyMaterial数据模型
 */
class WxyStudyMaterialTable {
	// 数据表模型配置
	public $config = [
			'name' => 'wxy_study_material',
			'title' => '学习资料表',
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
			'subject' => [
					'title' => '科目',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 1
			],
			'title' => [
					'title' => '标题',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'type' => [
					'title' => '资料类型',
					'come_from' => 0,
					'width' => '',
					'is_sort' => 0
			],
			'urls' => [
					'title' => '操作',
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
					'field' => 'varchar(100) NOT NULL',
					'type' => 'string',
					'is_must' => 1,
					'placeholder' => '请输入内容'
			],
			'subject' => [
					'title' => '科目',
					'type' => 'string',
					'field' => 'varchar(60) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'title' => [
					'title' => '标题',
					'type' => 'string',
					'field' => 'varchar(200) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'courseid' => [
					'title' => '课程ID',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'fileid' => [
					'title' => '文件ID',
					'type' => 'file',
					'field' => 'int(10) NULL',
					'is_show' => 1,
					'validate_file_size' => 10485760,
					'placeholder' => '请输入内容'
			],
			'order' => [
					'title' => '订阅人数',
					'type' => 'string',
					'field' => 'int(10) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'stage' => [
					'title' => '阶段',
					'type' => 'string',
					'field' => 'varchar(60) NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'description' => [
					'title' => '描述',
					'type' => 'editor',
					'field' => 'text NULL',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'type' => [
					'title' => '资料类型',
					'type' => 'string',
					'field' => 'varchar(60) NULL',
					'remark' => '类型（真题、专题、方法、模拟、通用）',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'image_id' => [
					'title' => '封面图片',
					'type' => 'picture',
					'field' => 'int(10) NULL',
					'remark' => '图片ID',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'image_material' => [
					'title' => '图片素材',
					'type' => 'image',
					'field' => 'int(10) NULL',
					'remark' => '图片素材',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			]
	];
}	