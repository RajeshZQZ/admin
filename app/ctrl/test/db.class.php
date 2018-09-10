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


public function connect_db(){
    $db = mysqli_connect(self::$mysql_server,self::$mysql_username,self::$mysql_password,self::$mysql_database);
    if (!empty($db)){
die('Mysql connect fails :'.mysqli_connect_error());
    }else {
        die('Mysql connect success!');
    }
    //断开数据库连接
    mysql_close($db);
}

public function close_mysql(){

}







}