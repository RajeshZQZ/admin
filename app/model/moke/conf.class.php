<?php
require_once APP_DIR.'model/base.class.php';
/**
 * Created by PhpStorm.
 * User: zengqingzhang
 * Date: 2018/9/19
 * Time: 15:49
 */

class model_moke_conf extends model_base
{

    public function insert($data){
        $db = parent::connect_db();
        $sql = "INSERT INTO moketest_config(name,typ,url,check_url,Interface_array,raw_add_time) VALUES(?,?,?,?,?,?);";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ssssss",$data['name'],$data['type'],$data['url'],$data['check_url'],$data['Interface_array'],'2018-09-18 03:50:36');
        $stmt->execute();
        $this ->close_mysql($db);
        return $res = $stmt->affected_rows;
    }

    public function test(){
        $db = parent::connect_db();
        $sql = "SELECT * FROM moketest_config WHERE 1;";
        $result = $db->query($sql);
        return $result;
    }
}

