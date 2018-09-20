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
echo "<br>11111".json_encode($data);
        if (empty($data)){
            die("提交数据为空~！请输入配置参数！");
            include_once TEMPLATE.'mokeConf.html';
            exit();
        }elseif (empty($data['name']) || empty($data['type']) || empty($data['url'])
        || empty($data['check_url']) || empty($data['Interface_array'])){
            die("提交数据不完整，请重新输入~！");
            include_once TEMPLATE.'mokeConf.html';
            exit();
        }
        $this ->input($data);
        $this ->output();
        exit;
    }


    public function input($data)
    {
        echo  "<br>22222".json_encode($data);

        $res = model_moke_conf::insert($data);
        if (empty($res)){
            die("数据插入失败~！");
        }else{
            //header('Location: http://47.98.188.59/game01/admin/');
            die("数据插入成功~！");
        }
    }

    public  function output(){
        echo "<br>44444";
        $result = model_moke_conf::get_conf();
        echo json_decode($result);
        while (!empty($result)){
            echo "<table border='1' width='600' cellpadding='5' cellspacing='0'>";
            echo "<tr>
                        <td>ID</td>
                        <td>Name</td>
                        <td>异步通知接口地址URL/td>
                        <td>加密方式</td>
                        <td>反查接口地址</td>
                        <td>异步通知接口参数数组</td>
                        </tr>";
            echo "<tr>";
            foreach ($result as $key=> $v){
               echo "<td>{$v}</td>";
            }
            echo "<tr>";
        }
    }


}

