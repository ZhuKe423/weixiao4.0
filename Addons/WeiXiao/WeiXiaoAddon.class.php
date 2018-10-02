<?php

namespace Addons\WeiXiao;
use Common\Controller\Addon;

/**
 * 微校插件
 * @author Weixiao Team
 */

    class WeiXiaoAddon extends Addon{

        public $info = array(
            'name'=>'WeiXiao',
            'title'=>'微校',
            'description'=>'提供学员管理、课程管理、成绩管理、考勤管理、资料发布等功能的教育培训应用。',
            'status'=>1,
            'author'=>'Weixiao Team',
            'version'=>'1.0',
            'has_adminlist'=>1
        );

	public function install() {
		$install_sql = './Addons/WeiXiao/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/WeiXiao/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }