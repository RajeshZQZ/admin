<?php
/**
 * Created by PhpStorm.
 * User: zengqingzhang
 * Date: 2018/9/19
 * Time: 15:49
 */

class ctrl_mock_implement{
static $data_arr = array();
static $data_para = array();
static $order_data = array();
    public function main(){
//        $id = $_POST['config_id'];
	$id = $_REQUEST['config_id'];
        if (!empty($id)){
            self::$data_arr = $this ->get_config($id);
            self::$data_para = explode(',',self::$data_arr['Interface_array']);
        }
        if (!empty(self::$data_para)){
            echo "<meta http-equiv='Content-Type' content='text/html;charset=utf-8' />";
            echo "<form action='http://47.98.188.59/game01/admin/?act=mock_implement&st=do_mock' method='post'>";
            echo "config_id:<br>
                  <input type='text' value='$id' name=config_id>
                  <br>";
            foreach (self::$data_para as $v) {
                self::$order_data[$v] = '';
                echo "{$v}:<br>
                  <input type='text' value='' name={$v}>
                  <br>";
            }
            echo "<input type='submit' value='提交'>";
            echo "</form>";
        }


    }


    public function get_config($conf_id){
        $db = new model_mock_info();
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

    public function do_mock(){
        $id = $_POST['config_id'];
        self::$order_data = $_POST;
        if (!empty($id)){
            self::$data_arr = $this ->get_config($id);
            self::$data_para = explode(',',self::$data_arr['Interface_array']);
        }else{
            echo "未拿到config_id~！";
        }
        echo json_encode(self::$data_arr);
        echo json_encode(self::$data_para);
        echo json_encode(self::$order_data);

        ctrl_mock_interface::call_back(self::$data_arr,self::$order_data);




    }

}
