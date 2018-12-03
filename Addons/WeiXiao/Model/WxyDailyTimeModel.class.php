<?php
/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2018/11/27
 * Time: 10:51
 */

namespace Addons\Weixiao\Model;
use Think\Model;

class WxyDailyTimeModel extends Model
{
    public function add_attendance_recode ($token,$studentno,$recordTimeStamp,$checkPosId,$lessonId) {
        $dailyTime['token'] = $token;
        $dailyTime['studentno'] = $studentno;
        $dailyTime['check_pos'] = $checkPosId;
        $dailyTime['lesson_id'] = $lessonId;
        $data = $this->where($dailyTime)->find();
        if (empty($data)) {
            $dailyTime['arriveTime'] = $recordTimeStamp;
            return $this->add($dailyTime);
        }else {
            return $data['id'];
        }
    }
}