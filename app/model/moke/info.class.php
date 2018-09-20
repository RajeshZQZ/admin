<?php
//require_once APP_DIR.'model/base1.class.php';
/**
 * Created by PhpStorm.
 * User: zengqingzhang
 * Date: 2018/9/19
 * Time: 15:49
 */

class model_moke_info extends model_base {
    static $db_config = '';
    static $db = '';
    public $table = "moketest_config";
    public $para = array();

    public function __construct()
    {
        self::$db = model_base::getInstance(self::$db_config);
    }

    public function insert_info($data){
        $para['name'] = $data['name'];
        $para['name'] = $data['type'];
        $para['name'] = $data['url'];
        $para['name'] = $data['check_url'];
        $para['name'] = $data['Interface_array'];
        date_default_timezone_set("Asia/Shanghai");
        $time = date('Y-m-d H:i:s',time());
        $para['time'] = $time;
        $res = self::$db->insert($this->table,$para);
        self::$db->getLastSql();
        return $res;
    }

    public function get_last_info(){
        $max['max'] = "max(id)";
        $condition = self::$db->select($this ->table,'',$max);
        $result = self::$db->select($this ->table,$condition);
        return $result;
    }

    public function get_all_info(){
        $result = self::$db->select($this ->table);
        return $result;
    }


}