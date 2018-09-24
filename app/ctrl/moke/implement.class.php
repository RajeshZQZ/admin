<?php
/**
 * Created by PhpStorm.
 * User: zengqingzhang
 * Date: 2018/9/19
 * Time: 15:49
 */

class ctrl_moke_implement{

    public function main(){
        $id = $_POST['config_id'];
        if (!empty($id)){
            $data_arr = $this ->get_config($id);
            $data_para = explode(',',$data_arr['Interface_array']);
        }
        if (!empty($data_para)){
            echo "<meta http-equiv='Content-Type' content='text/html;charset=utf-8' />";
            echo "<form action='http://47.98.188.59/game01/admin/?act=moke_implement&st=do_moke' method='post'>";
            echo "config_id:<br>
                  <input type='text' value='$id' name=config_id>
                  <br>";
            foreach ($data_para as $v) {
                $order_data[$v] = '';
                echo "{$v}:<br>
                  <input type='text' value='' name={$v}>
                  <br>";
            }
            echo "<input type='submit' value='提交'>";
            echo "</form>";
        }

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
        $id = $_POST['config_id'];
        $order_data = $_POST;
        if (!empty($id)){
            $data_arr = $this ->get_config($id);
            $data_para = explode(',',$data_arr['Interface_array']);
        }else{
            echo "未拿到config_id~！";
        }
        echo json_encode($data_arr);
        echo json_encode($data_para);
        echo json_encode($order_data);

    }

}