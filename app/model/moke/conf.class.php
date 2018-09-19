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
        echo json_encode($data)."<br>";
        $dba = parent::connect_db();
        $sql = "INSERT INTO moketest_config(name,typ,url,check_url,Interface_array,raw_add_time) VALUES(?,?,?,?,?,?);";
        $stmt = $dba->prepare($sql);
        //用变量绑定?表示的值,i表示整型,d表示浮点型,b代表二进制,s代表其它的所有
        $name = $data['name'];
        $tpye = $data['type'];
        $url  = $data['url'];
        $check_url = $data['check_url'];
        $Interface_array = $data['Interface_array'];
        $time = '2018-09-18 03:50:36';
        $stmt->bind_param("sissss",$name,$tpye,$url,$check_url,$Interface_array,$time);
        echo "准备执行~!";
        $res = $stmt->execute();
        echo $res ;
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

