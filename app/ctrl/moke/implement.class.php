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
        $data_arr = $this ->get_config($id);
        $data_para = array();
        $data_para = explode(',', $data_arr['Interface_array']);
echo json_encode($data_para);
        $order_data = '';
        echo "<meta http-equiv=\"Content-Type\" content=\"text/html;charset=utf-8\" />";
        echo "<form action='' method='post'>";
        foreach ($data_para as $v) {
            $order_data[$v] = '';
            echo "{$v}:
                  <input type='text' value='' name={$v}>
                  <br>";
        }
        echo "<input type='submit' value='提交'>";
        echo "</form>";
        $order_data = $_POST;
        echo json_encode($order_data);
        exit ;
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


}