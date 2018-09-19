<?php

/**
 * Created by PhpStorm.
 * User: zengqingzhang
 * Date: 2018/9/19
 * Time: 15:49
 */
//require_once APP_DIR.'model/conf.class.php';
class ctrl_moke_conf
{
    public function input()
    {
        $date = $_POST;
        echo $_POST;
        $pare = array(
            'name' => $_POST['name'],
            'type' => $_REQUEST['type'],
            'url' => $_REQUEST['url'],
            'check_url' => $_REQUEST['check_url'],
            'Interface_array' => $_REQUEST['Interface_array'] )
    $db = new model_moke_conf();
    $res = $db->insert($date);
if (!empty($res)) {
    echo "插入成功~！";
} else {
    echo "插入失败~！";
}
    }

}

