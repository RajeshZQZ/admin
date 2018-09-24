<?php
/**
 * Created by PhpStorm.
 * User: zengqingzhang
 * Date: 2018/9/19
 * Time: 15:49
 */

class ctrl_moke_implement{

static $data_para = array();
static $order_data = array();
    public function main(){
        $id = $_POST['config_id'];
        $data_arr =array();
        if (!empty($id)){
            $data_arr = $this ->get_config($id);
            self::$data_para = explode(',',$data_arr['Interface_array']);
        }
        if (!empty(self::$data_para)){
            echo "<meta http-equiv=\"Content-Type\" content=\"text/html;charset=utf-8\" />";
            echo "<form action='' method='post'>";
            foreach (self::$data_para as $v) {
                self::$order_data[$v] = '';
                echo "{$v}:<br>
                  <input type='text' value='' name={$v}>
                  <br>";
            }
            echo "<input type='text' value={$data_arr} name=data_arr>";
            echo "<input type='text' value='' name=data_para>";
            echo "<input type='submit' value='提交'>";
            echo "</form>";
        }
        self::$order_data = $_POST;
        $this->do_moke($data_arr,self::$order_data);
   //     ctrl_moke_interface::call_back($data_arr,$data_para,$order_data);

    }


    public function get_config($conf_id){
        $db = new model_moke_info();
        $results_conf = $db->get_conf($conf_id);
        $conf_arr = array();
        foreach ($results_conf as $key =>$v) {
            $result = $v;
            foreach ($result as $key1 => $v1) {
                $conf_arr[$key1] = $v1;
            }
        }
        return $conf_arr;
    }

    public function do_moke($data_arr,$order_data){
        echo json_encode($data_arr);
        echo json_encode(self::$data_para);
        echo json_encode($order_data);
    }

}