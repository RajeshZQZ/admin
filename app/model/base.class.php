<?php

/**
 * Created by PhpStorm.
 * User: zengqingzhang
 * Date: 2018/9/6
 * Time: 15:49
 */

class model_base{
    public $conn;
    public static $sql;
    public static $instance=null; //单例对象
    private $db_config;
    private function __construct($db_config = "db_mock.php"){
        require_once(DB."$db_config");
        $this->conn = new mysqli($mysql_server,$mysql_username,$mysql_password,$db);
        if(mysqli_connect_error()){
            //返回链接错误号
            // 返回链接错误信息
            die("数据库链接失败：".$this->conn->connect_error);
        }else{
            echo "数据库连接成功~！";
        }
    }

    private function __clone(){} //覆盖__clone()方法，禁止克隆

    public static function getInstance($db_config=''){
        if(is_null(self::$instance)) {
            if (empty($db_config)){
                self::$instance = new model_base();
            }else{
                self::$instance = new model_base($db_config);
            }
        }
        return self::$instance;
    }

    /* 查询数据
    $condition   条件
    $field       查询字段
    $table      表名
    */
    public function select($table,$order_by='',$limit ='',$condition=array(),$field = array()){
        $where='';
        if(!empty($condition)){
            foreach($condition as $k=>$v){
                $where.=$k."='".$v."' and ";
            }
            $where='where '.$where .'1=1';
        }
        $fieldstr = '';
        if(!empty($field)){
            foreach($field as $k=>$v){
                $fieldstr.= $v.',';
            }
            $fieldstr = rtrim($fieldstr,',');
        }else{
            $fieldstr = '*';
        }
        if (empty($order_by)){
            self::$sql = "select {$fieldstr} from {$table} {$where} {$limit};";
        }else{
            self::$sql = "select {$fieldstr} from {$table} {$where} ORDER BY {$order_by} {$limit};";
        }
        $result=mysqli_query($this->conn,self::$sql);
        $resuleRow = array();
        $i = 0;
        while($row = $result->fetch_assoc()){
            foreach($row as $k=>$v){
                $resuleRow[$i][$k] = $v;
            }
            $i++;
        }
        return $resuleRow;
        }
    /* 插入数据
      $data         插入值
      $values       插入字段
      $table        表名
      */
public function insert($table,$data)
{
    $values = '';
    $datas = '';
    foreach ($data as $k => $v) {
        $values .= $k . ',';
        $datas .= "'$v'" . ',';
    }
    $values = rtrim($values, ',');
    $datas = rtrim($datas, ',');
    self::$sql = "INSERT INTO  {$table} ({$values}) VALUES ({$datas});";
    if (mysqli_query($this->conn,self::$sql)) {
        return mysqli_insert_id($this->conn);
    } else {
        return false;
    }
}
//打印最后执行的SQL
    public function getLastSql(){
        echo self::$sql;
    }
}
