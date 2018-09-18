<?php

/**
 * Created by PhpStorm.
 * User: zengqingzhang
 * Date: 2018/9/6
 * Time: 15:49
 */
class ctrl_test_db
{
/*创建数据库连接，关闭等功能
 *
 *
 *
 */
static $mysql_server = '47.98.188.59';
static $mysql_username = 'root';
static $mysql_password = 'pig123456';
static $mysql_database = 'db_moke';


public function connect_db($mysql_database='db_moke'){
    $db = new mysqli(self::$mysql_server,self::$mysql_username,self::$mysql_password,$mysql_database);
    if(mysqli_connect_error()){
    //返回链接错误号
    // 返回链接错误信息
        die("数据库链接失败：".$conn->connect_error);
    }else{
        echo "数据库连接成功~！";
    }
   // $result=$db->query("SELECT `id` FROM `moketest_config` where 1");
   // $row=$result->fetch_row();
   // var_dump($row);
   //断开数据库连接
   // mysql_close($db);
}

public function close_mysql($db){
    //断开数据库连接
    mysql_close($db);
}

public function select_mysql($sql){

}

public function insert_mysql($sql){

}

public function delete_mysql($sql){

}

public function update_mysql($sql){

}



}