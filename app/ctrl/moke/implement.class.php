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
        $data = $this ->get_config($id);
        $data_para = array();
        $data_para = explode(',', $data['Interface_array']);
echo json_encode($data_para);









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