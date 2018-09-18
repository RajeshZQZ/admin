<?php

/**
 * Created by PhpStorm.
 * User: zengqingzhang
 * Date: 2018/9/19
 * Time: 15:49
 */

class model_moke_conf extends model_base
{

    public function insert($data){
        $db = $this ->connect_db();
        $sql = "INSERT INTO moketest_config(name,typ,url,check_url,Interface_array,raw_add_time) VALUES(?,?,?,?,?,?);";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ssssss",$data['name'],$data['type'],$data['url'],$data['check_url'],$data['Interface_array'],now());
        $stmt->execute();
        $this ->close_mysql($db);
        return $res = $stmt->affected_rows;
    }
}

