<?php

/**
 * Created by PhpStorm.
 * User: zengqingzhang
 * Date: 2018/9/19
 * Time: 15:49
 */

class ctrl_moke_conf
{

    public function input()
    {
        $date = array('name' => $_REQUEST['name'],
            'type' => $_REQUEST['type'],
            'url' => $_REQUEST['url'],
            'check_url' => $_REQUEST['check_url'],
            'Interface_array' => $_REQUEST['Interface_array'],)


   // $Interface_array = explode(',', $_REQUEST('Interface_array'))
    $res = model_moke_conf::insert($date);
if (!empty($res)) {
    echo "插入成功~！";
} else {
    echo "插入失败~！";
}
    }

}

