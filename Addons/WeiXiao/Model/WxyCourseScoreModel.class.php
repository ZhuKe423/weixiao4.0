<?php
/**
 * Created by PhpStorm.
 * User: qiaoc
 * Date: 2018/11/30
 * Time: 13:45
 */

namespace Addons\WeiXiao\Model;

use Think\Model;
/**
 * Score模型
 */
class WxyCourseScoreModel extends Model{
    protected $tableName = 'wxy_score';

    public function addScore($data){
        $map ['token'] = $data['token'];
        $map ['courseid'] = $data['courseid'];
        $map ['studentno'] = $data['studentno'];
        $map ['lesson_id'] = $data['lesson_id'];
        //var_dump($data);
        //var_dump($this->where[$map]);
        $res = $this->where($map)->find();
        if ($res != NULL) {
            $this->where($map)->save($data);
            return $res['id'];
        } else {
            //dump($data);
            $res = $this->add ( $data );
            return $res;
        }
    }

    public function verify($map) {
        $data = $this->where($map)->find();
        if ($data != NULL) {
            return $data;
        }
        else
            return false;
    }

    public function send_score_to_user($openId, $url, $info, $token, $public_name, $score_label = null){
        if ($info == NULL) return false;
        $map['token'] = $token;
        $map['msg_type'] = 'score notification';

        $msg_template = D('WxyWxTemplate')->where($map)->find();
        $template_id = $msg_template['msg_id'];

        $test_score = ($info["exmscore"]==NULL)?'':"\n                    测试成绩：".$info["exmscore"];
        $teacher_comment = '';
        $blank = "\n                    ";
        $score_str = '';
        if ($score_label == null) {
            $score_str = $blank . "分数：". $info['score'];
        } else {
            empty($score_label['score1']) || $score_str .= $blank . $score_label['score1'] ."：". $info['score1'];
            empty($score_label['score2']) || $score_str .= $blank . $score_label['score2'] ."：". $info['score2'];
            empty($score_label['score3']) || $score_str .= $blank . $score_label['score3'] ."：". $info['score3'];
            empty($score_label['score']) || $score_str .= $blank . $score_label['score'] ."：". $info['score'];
        }
        empty($info['comment']) || $teacher_comment = "老师评语：" . $info['comment'];
        $data = array(
            "first"         =>  array(
                'value' => "亲爱的" . $info["stuname"] . "家长，" . $info["stuname"] . "同学在：\n" . $info["site"] . $info["grade"] . $info["course"] . "课程\n学习中的成绩情况如下：",
                'color' => '#0000ff'
            ),

            "keyword1"    =>  array(
                'value' => $info["course"],
                'color' => '#0000ff'
            ),
            "keyword2"          =>  array (
                'value' => date('Y-m-d', strtotime($info['classdate'])),
                'color' => '#0000ff'
            ),
            "keyword3"         => array(
                'value' => $public_name,
                'color' => '#0000ff'
            ),

            "keyword4"         =>  array(
                'value' =>  $score_str,
                'color' => '#0000ff'
            ),
            "remark"        =>  array(
                'value' => $teacher_comment,
                'color' => '#008000'
            )
        );
        return $this->send_msg_form($openId, $template_id, $url, $data);
    }

    private function http_post($url, $param) {
        $oCurl = curl_init ();
        if (stripos ( $url, "https://" ) !== FALSE) {
            curl_setopt ( $oCurl, CURLOPT_SSL_VERIFYPEER, FALSE );
            curl_setopt ( $oCurl, CURLOPT_SSL_VERIFYHOST, false );
        }
        if (is_string ( $param )) {
            $strPOST = $param;
        } else {
            $aPOST = array ();
            foreach ( $param as $key => $val ) {
                $aPOST [] = $key . "=" . urlencode ( $val );
            }
            $strPOST = join ( "&", $aPOST );
        }
        curl_setopt ( $oCurl, CURLOPT_URL, $url );
        curl_setopt ( $oCurl, CURLOPT_RETURNTRANSFER, 1 );
        curl_setopt ( $oCurl, CURLOPT_POST, true );
        curl_setopt ( $oCurl, CURLOPT_POSTFIELDS, $strPOST );
        $sContent = curl_exec ( $oCurl );
        $aStatus = curl_getinfo ( $oCurl );
        /*echo '<p></p>';
        var_dump($sContent);
        echo '<p></p>';
        var_dump($aStatus);
        echo '<p></p>';
        var_dump($strPOST);
        echo '<p></p>';*/
        curl_close ( $oCurl );
        if (intval ( $aStatus ["http_code"] ) == 200) {
            return $sContent;
        } else {
            return false;
        }
    }
    public function send_msg_form($openid,$template_id,$url,$data){
        $postData = array(
            "touser"=>$openid,
            "template_id"=>$template_id,
            "url"=>$url,
            "topcolor" => "#7B68EE",
            "data"=>$data);
        $acc_token = get_access_token();
        /*echo "<p> the result is: </p>";
        var_dump($postData);
        echo "<p> the result is: </p>";*/
        $retData = false;
        $retData = $this->http_post("https://api.weixin.qq.com/cgi-bin/message/template/send?access_token=".$acc_token,json_encode($postData));
        /*echo "<p> the result is: </p>";
        var_dump($retData);*/

        if ($retData == false){
            addWeixinLog ( "sendMsgForm Error: send message time out");
            return NULL;
        }else {
            return $retData;
        }
    }
}
