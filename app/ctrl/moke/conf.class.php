<?php

/**
 * Created by PhpStorm.
 * User: zengqingzhang
 * Date: 2018/9/19
 * Time: 15:49
 */
//require_once APP_DIR.'model/conf.class.php';
class ctrl_moke_conf
{
    public function main(){
        $data = array();
        $data['name'] = $_POST['name'];
        $data['type'] = $_POST['type'];
        $data['url'] = $_POST['url'];
        $data['check_url'] = $_POST['check_url'];
        $data['Interface_array'] = $_POST['Interface_array'];
        if (empty($data)){
            echo "提交数据为空~！请输入配置参数！";
            include_once TEMPLATE.'mokeConf.html';
            exit();
        }elseif (empty($data['name']) || empty($data['type']) || empty($data['url'])
        || empty($data['check_url']) || empty($data['Interface_array'])){
            include_once TEMPLATE.'mokeConf.html';
            die("提交数据不完整，请重新输入~！");
        }
        $this ->input($data);
        $this ->output();
    }


    public function input($data)
    {
        $db = new model_moke_info();
        $res = $db->insert_info($data);
        if (empty($res)){
            die("数据插入失败~！");
        }else{
            //header('Location: http://47.98.188.59/game01/admin/');
            echo "数据插入成功~！";
        }
    }

    public  function output(){
        $db = new model_moke_info();
        $result = $db->get_last_info();
        if (!empty($result)){
            echo "<table border='1' width='600' cellpadding='5' cellspacing='0'>";
            echo "<tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>异步通知接口地址URL<td>
                        <td>加密方式</td>
                        <td>反查接口地址</td>
                        <td>异步通知接口参数数组</td>
                        <td>添加时间</td>
                        </tr>";
            echo "<tr>";
            foreach ($result as $key=> $v){
               echo "<td>{$v}</td>";
            }
            echo "<tr>";
        }else{
            die("未查询到数据~！");
        }
    }


}

