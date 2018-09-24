<?php
//require_once APP_DIR.'model/base1.class.php';
/**
 * Created by PhpStorm.
 * User: zengqingzhang
 * Date: 2018/9/19
 * Time: 15:49
 */

class model_moke_info extends model_base {
    private $db_config = '';
    static $db = '';
    public $table = "moketest_config";
    public $para = array();

    public function __construct()
    {   //获取实例化单例
        self::$db = model_base::getInstance($this->db_config);
    }

    public function insert_info($data){
        $para['name'] = $data['name'];
        $para['type'] = $data['type'];
        $para['url'] = $data['url'];
        $para['app_cecret'] = $data['app_cecret'];
        $para['check_url'] = $data['check_url'];
        $para['Interface_array'] = $data['Interface_array'];
        date_default_timezone_set("Asia/Shanghai");
        $time = date('Y-m-d H:i:s',time());
        $para['raw_add_time'] = $time;
        $res = self::$db->insert($this->table,$para);
       // self::$db->getLastSql();
        return $res;
    }

    public function get_last_info(){
        $max['max'] = "max(id)";
        $limit = "limit 1";
        $order_by = 'id DESC';
        $condition = self::$db->select($this ->table,'','','',$max);
        $result = self::$db->select($this->table,$order_by,$limit,$condition);
        return $result;
    }

    public function get_all_info(){
        $order_by = 'id DESC';
        $result = self::$db->select($this ->table,$order_by);
        return $result;
    }

    public function get_conf($id){
        $limit = "limit 1";
        $condition = array('id'=>'$id');
        $result = self::select($this ->table,'',$limit,$condition);
        return $result;
    }
}