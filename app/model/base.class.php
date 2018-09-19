<?php

/**
 * Created by PhpStorm.
 * User: zengqingzhang
 * Date: 2018/9/6
 * Time: 15:49
 */
class model_base
{
    /*创建数据库连接，关闭等功能
     */
    static $mysql_server = '47.98.188.59';
    static $mysql_username = 'root';
    static $mysql_password = 'pig123456';
    static $db =NULL;
    static $_instance;
    public function connect_db($mysql_database='db_moke'){
        if (self::$db== null){
            self::$db = new mysqli(self::$mysql_server,self::$mysql_username,self::$mysql_password,$mysql_database);
        }
        if(mysqli_connect_error()){
            //返回链接错误号
            // 返回链接错误信息
            die("数据库链接失败：".self::$db->connect_error);
        }else{
            echo "数据库连接成功~！";
            return self::$db;
        }
        // $result=$db->query("SELECT `id` FROM `moketest_config` where 1");
        // $row=$result->fetch_row();
        // var_dump($row);
        //断开数据库连接
        // mysql_close($db);
    }

    /**
     * 获取多行数据
     */
    public function getAll($sql){
        $data = array();
        $res = $this->connect_db()->query($sql);
        while($row = $res->fetch_assoc()){
            $data = $row;
        }
        return $data;
    }

    public function close_mysql($db){
        //断开数据库连接
        mysqli_close($this->connect_db());
    }


}