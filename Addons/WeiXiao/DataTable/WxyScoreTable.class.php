<?php
/**
 * WxyScore数据模型
 */
class WxyScoreTable {
	// 数据表模型配置
	public $config = [
			'name' => 'wxy_score',
			'title' => '成绩表',
			'search_key' => '',
			'add_button' => 1,
			'del_button' => 1,
			'search_button' => 1,
			'check_all' => 1,
			'list_row' => 10,
			'addon' => 'WeiXiao'
	];
	
	// 列表定义
	public $list_grid = [ ];
	
	// 字段定义
	public $fields = [
			'token' => [
					'title' => '机构Token',
					'field' => 'varchar(100) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'courseid' => [
					'title' => '课程ID',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'lesson_id' => [
					'title' => '课时编号',
					'type' => 'num',
					'field' => 'int(11) NULL',
					'remark' => '课时编号',
					'is_show' => 1,
					'placeholder' => '请输入内容'
			],
			'course_name' => [
					'title' => '课程名称',
					'field' => 'varchar(200) NOT NULL',
					'type' => 'string',
					'is_must' => 1,
					'placeholder' => '请输入内容'
			],
			'sequence' => [
					'title' => '课程序号',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'classdate' => [
					'title' => '上课时间',
					'field' => 'datetime NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'sid' => [
					'title' => '学生ID',
					'field' => 'varchar(20) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'studentno' => [
					'title' => '学号',
					'field' => 'varchar(20) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'name' => [
					'title' => '姓名',
					'field' => 'varchar(50) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'termid' => [
					'title' => '测试编号',
					'field' => 'int(10) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'term' => [
					'title' => '测试名称',
					'field' => 'varchar(100) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'subject' => [
					'title' => '科目',
					'field' => 'varchar(60) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'score' => [
					'title' => '总分数',
					'field' => 'varchar(50) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'score1' => [
					'title' => '分数一',
					'field' => 'varchar(50) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'score2' => [
					'title' => '分数二',
					'field' => 'varchar(50) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'score3' => [
					'title' => '分数三',
					'field' => 'varchar(50) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'award' => [
					'title' => '奖项',
					'field' => 'varchar(50) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'exmscore' => [
					'title' => '测试分数',
					'field' => 'varchar(50) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'weixinmsgsend' => [
					'title' => '微信消息发送',
					'field' => 'varchar(50) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'comment' => [
					'title' => '备注',
					'field' => 'varchar(200) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			],
			'room' => [
					'title' => '教室',
					'field' => 'varchar(50) NULL',
					'type' => 'string',
					'placeholder' => '请输入内容'
			]
	];
}	