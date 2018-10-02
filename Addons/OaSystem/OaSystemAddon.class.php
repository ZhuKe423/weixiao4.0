<?php

namespace Addons\OaSystem;
use Common\Controller\Addon;

/**
 * OA系统插件
 * @author zhuke
 */

    class OaSystemAddon extends Addon{

        public $info = array(
            'name'=>'OaSystem',
            'title'=>'OA系统',
            'description'=>'微信小程序OA系统',
            'status'=>1,
            'author'=>'zhuke',
            'version'=>'0.1',
            'has_adminlist'=>1
        );

	public function install() {
		$install_sql = './Addons/OaSystem/install.sql';
		if (file_exists ( $install_sql )) {
			execute_sql_file ( $install_sql );
		}
		return true;
	}
	public function uninstall() {
		$uninstall_sql = './Addons/OaSystem/uninstall.sql';
		if (file_exists ( $uninstall_sql )) {
			execute_sql_file ( $uninstall_sql );
		}
		return true;
	}

        //实现的weixin钩子方法
        public function weixin($param){

        }

    }