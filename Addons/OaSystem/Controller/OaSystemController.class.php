<?php

namespace Addons\OaSystem\Controller;
use Think\ManageBaseController;

class OaSystemController extends ManageBaseController{

    function lists(){
        /*
        $url = addons_url ( 'OaSystem://OaUser/lists' ,array('mdm'=>I('mdm')));
        var_dump($url);
        $this->redirect($url);
        */
        $this->redirect('OaSystem/OaUser/lists');
    }
}
