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
    static $dba = NULL;
    public function insert($data){
        echo "<br>3333".json_encode($data)."<br>";
        self::$dba = parent::connect_db();
        $sql = "INSERT INTO moketest_config(name,typ,url,check_url,Interface_array,raw_add_time) VALUES(?,?,?,?,?,?);";
        $stmt = self::$dba->prepare($sql);
        //用变量绑定?表示的值,i表示整型,d表示浮点型,b代表二进制,s代表其它的所有
        $name = $data['name'];
        $tpye = $data['type'];
        $url  = $data['url'];
        $check_url = $data['check_url'];
        $Interface_array = $data['Interface_array'];
        date_default_timezone_set("Asia/Shanghai");
        $time = date('Y-m-d H:i:s',time());
        $stmt->bind_param("sissss",$name,$tpye,$url,$check_url,$Interface_array,$time);
        echo "准备执行~!";
        $res = $stmt->execute();
        echo $res ;
        mysqli_close($dba);
        return $res;
    }

    public function get_conf(){
        self::$dba = parent::connect_db();
        $sql = "SELECT * FROM ? WHERE (SELECT max(id) FROM ?) ORDER BY `id` DESC limit 1;";
        $stmt = self::$dba ->prepare($sql);
        $tab = "moketest_config";
        $stmt->bind_param("ss", $tab,$tab);
        $stmt->execute();
        $result = $stmt->get_result();
 //       $result = $dba->query($sql);
        $date = $result->fetch_assoc();
    //  echo "<br>test:".json_encode($date);
        $result->close();
        mysqli_close($dba);
        return $date;
    }

    public function get_conf_list(){
        $dba = parent::connect_db();
        $sql = "SELECT * FROM `moketest_config` WHERE 1;";
        echo $sql;
        $result = $dba->query($sql);
        $date = $result->fetch_assoc();
        //  echo "<br>test:".json_encode($date);
        mysqli_close($dba);
        return $date;
    }
}

