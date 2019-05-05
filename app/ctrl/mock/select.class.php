<?php
/**
 * Created by PhpStorm.
 * User: zengqingzhang
 * Date: 2018/9/19
 * Time: 15:49
 */

class ctrl_mock_select extends ctrl_mock_conf {
//获取后台配置
    public function main(){
        $this->show_conf();
        include_once TEMPLATE."mockOrder.html";

    }
//展示后台配置信息
    public function show_conf(){
        $this->output($flag=1);
    }

}
