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
        include_once TEMPLATE."mokeOrder.html";

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

    public  function output($flag=0){
        $db = new model_moke_info();
        $results_one = $db->get_last_info();
        if (!empty($results_one)) {
            if ($flag==0){
            echo "<h2>当前插入数据：</h2>";
            }else{
            echo "<h2>最新插入数据：</h2>";
            }
            echo "<table border='1' width='95%' cellpadding='5' cellspacing='0'>";
            echo "     <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>异步通知接口地址URL</th>
                        <th>加密方式</th>
                        <th>反查接口地址</th>
                        <th>异步通知接口参数数组</th>
                        <th>添加时间</th>
                        </tr>";
            $result = array();
            foreach ($results_one as $key =>$v) {
                echo "<tr>";
                $result = $v;
                foreach ($result as $key1 => $v1) {
                    echo "<td>{$v1}</td>";
                }
                echo "<tr>";
                echo "</table>";
            }
        }else {
            die("未查询到数据~！");
        }
      //所有数据
        $results_all = $db->get_all_info();
            if(!empty($results_all)){
            echo "<h2>目所有配置数据：</h2>";
            echo "<table border='1' width='95%' cellpadding='5' cellspacing='0'>";
            echo "     <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>异步通知接口地址URL</th>
                        <th>加密方式</th>
                        <th>反查接口地址</th>
                        <th>异步通知接口参数数组</th>
                        <th>添加时间</th>
                        </tr>";
            $result2 = array();
            foreach ($results_all as $key2=>$v2) {
                echo "<tr>";
                $result2 = $v2;
                foreach ($result2 as $key3 => $v3) {
                    echo "<td>{$v3}</td>";
                }
                echo "<tr>";
                }
                echo "</table>";
        }else{
            die("未查询到数据~！");
        }
    }


}

