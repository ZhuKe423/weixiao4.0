<?php

namespace Addons\OaSystem\Model;
use Think\Model;

/**
 * OaSystem模型
 */
class OaDeptModel extends Model{
    public function updateDept($data){
        $map ['appid'] = $data['appid'];
        $map ['dept_no'] = $data['dept_no'];

        if ($this->where($map)->select() != NULL)
            return $this->where($map)->save($data);
        else
        {
            $res = $this->add ( $data );
            return $res;
        }
    }
}
