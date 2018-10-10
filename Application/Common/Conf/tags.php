<?php
return array(
	'app_init' => array('Common\Behavior\InitHookBehavior', //Hook
        ),
    'view_filter' => array(
        'Behavior\TokenBuildBehavior', // 表单令牌
        ),
);

