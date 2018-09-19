<?php
//require_once APP_DIR.'model/base.class.php';
/**
 * Created by PhpStorm.
 * User: zengqingzhang
 * Date: 2018/9/19
 * Time: 15:49
 */

class model_moke_conf extends model_base
{

    public function insert($data){
        $dba = parent::connect_db();
        $sql = "INSERT INTO moketest_config(name,typ,url,check_url,Interface_array,raw_add_time) VALUES(?,?,?,?,?,?);";
        $stmt = $dba->prepare($sql);
        //用变量绑定?表示的值,i表示整型,d表示浮点型,b代表二进制,s代表其它的所有
        $stmt->bind_param("sissss",$data['name'],$data['type'],$data['url'],$data['check_url'],$data['Interface_array'],'2018-09-18 03:50:36');
        $res = $stmt->execute();
        parent::close_mysql($dba);
        return $res;
    }

    public function test(){
        $dba = parent::connect_db();
        $sql = "SELECT * FROM `moketest_config` WHERE 1;";
        echo $sql;
        $result = $dba->query($sql);
        $date = $result->fetch_assoc();
        echo "<br>test:".json_encode($date);
        return $date;
    }
}

