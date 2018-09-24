<?php
/**
 * Created by PhpStorm.
 * User: zengqingzhang
 * Date: 2018/9/19
 * Time: 15:49
 */

class curl_moke_select extends ctrl_moke_conf {
//获取后台配置
    public function main(){
        $this->show_conf();
        include_once TEMPLATE."mokeOrder.html";

    }
//展示后台配置信息
    public function show_conf(){
        $this->output($flag=1);
    }

}