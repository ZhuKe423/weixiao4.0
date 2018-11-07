<?php
return array(
	'random'=>array(//配置在表单中的键名 ,这个会是config[random]
		'title'=>'是否开启随机:',//表单的文字
		'type'=>'radio',		 //表单的类型：text、textarea、checkbox、radio、select等
		'options'=>array(		 //select 和radion、checkbox的子选项
			'1'=>'开启',		 //值=>文字
			'0'=>'关闭',
		),
		'value'=>'1',			 //表单的默认值
	),
    'title' => array (
        'title' => '封面标题:',
        'type' => 'text',
        'value' => '微校系统',
        'tip' => ''
    ),
    'cover' => array (
        'title' => '封面图片:',
        'type' => 'picture',
        'value' => '',
        'tip' => '最佳尺寸为900*500'
    ),
    'info' => array (
        'title' => '封面简介:',
        'type' => 'textarea',
        'value' => '',
        'tip' => ''
    ),
    'show_background' => array (
        'title' => '显示模板背景图',
        'type' => 'radio',
        'value' => '1',
        'options' => array (
            '0' => '不显示',
            '1' => '显示'
        ),
        'tip' => ''
    ),
    'background' => array (
        'title' => '模板背景图:',
        'type' => 'mult_picture',
        'value' => '',
        'tip' => '为空时默认使用模板里的背景图片，最佳尺寸：640X1156'
    ),

    'code' => array (
        'title' => '统计代码:',
        'type' => 'textarea',
        'value' => '',
        'tip' => ''
    ),
    'template_index' => array (
        'title' => '首页模板',
        'type' => 'hidden',
        'value' => 'ColorV1',
        'tip' => ''
    ),
    'template_footer' => array (
        'title' => '底部模板',
        'type' => 'hidden',
        'value' => 'V1',
        'tip' => ''
    ),
    'template_lists' => array (
        'title' => '图文列表模板',
        'type' => 'hidden',
        'value' => 'V1',
        'tip' => ''
    ),
    'template_detail' => array (
        'title' => '图文内容模板',
        'type' => 'hidden',
        'value' => 'V1',
        'tip' => ''
    ),
    'grade_value' => array(
        'title' => '年级选项',
        'value' => array (
            '7' => '初一',
            '8' => '初二',
            '9' => '初三',
            '10' => '高一',
            '11' => '高二',
            '12' => '高三',
            '21' => '小学一年级',
            '22' => '小学二年级',
            '23' => '小学三年级',
            '24' => '小学四年级',
            '25' => '小学五年级',
            '26' => '小学六年级'
        )
    ),
    'subject_value' => array(
        'tile'  => '科目选项',
        'value' => array (
            '1' => '数学',
            '2' => '英语',
            '3' => '语文',
            '4' => '物理',
            '5' => '化学',
            '6' => '生物'
        )
    ),
    'material_type' => array(
        'title' => '资料类型',
        'value' =>array (
            '1' =>'真题宝典',
            '2' =>'巧思妙解',
            '3' =>'每周一拨',
            '4' =>'等你来嗨',
            '5' =>'真题',
            '6' =>'模拟题',
            '7' =>'专题',
            '8' =>'学习方法',
            '9' =>'通用'
        )
    ),
    'problem_type' => array(
        'title' => '真题类型',
        'value' => array(
            '1' => '升学真题',
            '2' => '竞赛真题',
            '3' => '名校题库'
        )
    ),

    'course_status' => array(
        'title' => '课程状态',
        'value' => array (
            '0' => '即将开课',
            '1' => '进行中',
            '2' => '结束',
        )
    )
);
					