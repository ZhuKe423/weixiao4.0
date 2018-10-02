<?php
        	
namespace Addons\OaSystem\Model;
use Home\Model\WeixinModel;
        	
/**
 * OaSystem的微信模型
 */
class WeixinAddonModel extends WeixinModel{
	function reply($dataArr, $keywordArr = array()) {
		$config = getAddonConfig ( 'OaSystem' ); // 获取后台插件的配置参数	
		//dump($config);
	}
}
        	