<?php
//require_once APP_DIR.'model/base1.class.php';
/**
 * Created by PhpStorm.
 * User: zengqingzhang
 * Date: 2018/9/19
 * Time: 15:49
 */

class model_mock_info extends model_base {
    private $db_config = '';
    static $db = '';
    public $table = "mocktest_config";
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
        $condition['id'] = $id;
        $result = self::$db->select($this ->table,'',$limit,$condition);
   //     self::$db->getLastSql();
        return $result;
    }

    public function get_order($order_id){
        $limit = "limit 1";
        $condition['order_id'] = $order_id;
        $order_table = "mock_order";
        $result1 = array();
        $results = self::$db->select($order_table, '', $limit, $condition);
        if (empty($results)) {
            return null;
        } else {
            foreach ($results as $key1 => $v1) {
                $result1 = $v1;
            }
            $result2['id'] = $result1['id'];
            $result2['config_id'] = $result1['config_id'];
            $result_order = json_decode($result1['arr_order'],TRUE);

        //    echo "1111get_order_result_order" . json_encode($result_order);
            foreach ($result_order as $key2 => $v2) {
                $result2[$key2] = $v2;
            }
        //    echo "2222get_order_result2" . json_encode($result2);

            //     self::$db->getLastSql();
            return $result2;
        }
    }

//保存订单数据
    public function save_order($call_orders){
        $para['config_id'] = $call_orders['config_id'];
        $para['order_id'] = $call_orders['order_id'];
        $para['arr_order'] = json_encode($call_orders['arr_order']);
        date_default_timezone_set("Asia/Shanghai");
        $time = date('Y-m-d H:i:s',time());
        $para['raw_add_time'] = $time;
      //  echo "1111save_order$para".json_encode($para);
        $order_table = "mock_order";
        $res = self::$db->insert($order_table,$para);
        // self::$db->getLastSql();
        return $res;

    }
}
