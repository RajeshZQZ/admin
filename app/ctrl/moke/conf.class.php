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
        echo  json_encode($_POST);
      $pare = array(
           'name' => $_POST['name'],
           'type' => $_POST['type'],
           'url' => $_POST['url'],
           'check_url' => $_POST['check_url'],
           'Interface_array' => $_POST['Interface_array'] );
  //  $res = model_moke_conf::test();
        $res = model_moke_conf::insert($pare);
        if (!$res){
            echo "<br>数据插入失败~！<br>";
        }else{
            echo "<br>数据插入成功~！<br>";
        }
/*/if (!empty($res)) {
  //  echo "插入成功~！";
} //else {
    //echo "插入失败~！";
}*/
    }

}

