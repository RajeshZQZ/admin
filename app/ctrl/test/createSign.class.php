<?php
/**
 * Created by PhpStorm.
 * User: dell
 * Date: 2019/4/19
 * Time: 11:12
 */

/**
服务器sign_key:
const sign_key = 'KoQAW@ee@IR!Q@w348lPuh06ik4LDkJl';
生成规则：
MD5(sign_key + unSign)  ==  sign
md5($unSign.self::sign_key) != $sign
 */
class createSign{
    const sign_key = "KoQAW@ee@IR!Q@w348lPuh06ik4LDkJl";

    public function create_sign(){
    $time = time();
    $timestamp = intval($time);
    $unSign = "timestamp=".$time;
    md5($unSign.self::sign_key);



    }





}