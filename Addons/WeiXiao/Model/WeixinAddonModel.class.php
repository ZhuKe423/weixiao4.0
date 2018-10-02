<?php
        	
namespace Addons\WeiXiao\Model;
use Home\Model\WeixinModel;
        	
/**
 * WeiXiao的微信模型
 */
class WeixinAddonModel extends WeixinModel{
	function reply($dataArr, $keywordArr = array()) {
		$config = getAddonConfig ( 'WeiXiao' ); // 获取后台插件的配置参数	
		//dump($config);
	}
}
        	