<?php
/**
 * Created by PhpStorm.
 * User: zengqingzhang
 * Date: 2018/9/19
 * Time: 15:49
 */

class ctrl_mock_interface {
   // const APP_SECRET = "12f03456079a4e208ab2bb44183564f5" ;//秘钥
    //const URL = "http://10test16-wap.stg3.1768.com/shijijy_notify.php";
    static $url = '';
    static $app_secret = '';

    //订单异步通知
    public static function call_back($data_arr,$order_data){
        /*
        $memcache = new framework_base_memcached();
        $memKey = 'shijijiayuan:youximocktest:sjjy:order_id:'.$_GET['orderId'];
        $memRes = $memcache->get_cache($memKey);
        */
        self::$app_secret = $data_arr['app_secret'];
        self::$url = $data_arr['url'];
        $call_orders = array();
        $order_id = $order_data['order_id'];
        $db = new model_mock_info();
        $call_order = $db->get_order($order_id);

        if(empty($call_order)){
            $call_orders['arr_order'] = $order_data;
            $call_orders['config_id'] = $order_data['config_id'];
            $call_orders['order_id'] = $order_id;
           // echo "interface+++++++++++call_orders".json_encode($call_orders);
            $addSucc = $db->save_order($call_orders);
            if(!$addSucc){
                echo "订单入库保存失败！";
                exit;
            }else{
                $call_order = $db->get_order($order_id);
            }
        }
        date_default_timezone_set("Asia/Shanghai");
        $data = array(
            "cporderid"=>$call_order['order_id'],
            "openid"=>$call_order['openid'],
            "reqDate"=>date("Y-m-d H:i:s",time()),
            "timestamp"=>time(),
            "amount"=>$call_order['amount'],
            "fee_amount"=>$call_order['fee_amount'],
            "real_amount"=>$call_order['amount']-$call_order['fee_amount'],
            "fee_rate"=>round($call_order['fee_amount']/$call_order['amount'],2)
        );
        echo "<br>data".json_encode($data);

//排序
        $data_str = self::sort_array($data);
	echo "<br>";
        echo $data_str;
//加密
        $request = array("result"=>self::encrypt($data_str),
            "sign"=>self::sign($data_str,self::$app_secret)
        );
        $request_json = json_encode($request);
//      self::default_curl($request_json);

    }

    //订单反差接口
    public static function call(){
        $order_id = $_GET['orderId'];
        echo $order_id;
        $db = new model_mock_info();
        $call_order = $db->get_order($order_id);

        if(empty($call_order)){
            echo "订单信息获取失败！";
            exit;
        }
        $response = array("code"=>0, //0成功 1失败
            //可以修改
            "message"=>"success",
            "orderId"=>$call_order['order_id'],
            "open_id"=> $call_order['openid'],
            "order_date"=>date("Y-m-d H:i:s",time()-300),
            "timestamp"=>time(),
            "amount"=>$call_order['amount'],
            "fee_amount"=> $call_order['fee_amount'],
            "real_amount"=>$call_order['amount']-$call_order['fee_amount'],
            "fee_rate"=>round($call_order['fee_amount']/$call_order['amount'],2),
            //可以修改
            "callback_status"=>0,//0未通知到合作方，1已通知到合作方，2通知失败
            "callback_time"=>time()-200 //仅当callback_status为1时有效

        );
        echo json_encode($response);

    }


    //验签
    public static function encrypt($data){
        $key_len = 1024;
        $max = ($key_len / 8) - 11;

        $encrypted = "";
        $encrypted_str = "";

        $pubkey = file_get_contents("http://47.98.188.59/game01/admin/app/rsa_private_key.pem");

        $len = ceil(strlen($data)/$max);
        for ($i=0; $i<$len ; $i++) {
            $tmp = substr($data, $i*$max, $max);
            openssl_private_encrypt($tmp, $encrypted, $pubkey, OPENSSL_PKCS1_PADDING);
            $encrypted_str .= $encrypted;
            $encrypted = '';
        }
        return base64_encode($encrypted_str);
    }

    //sha256加密
    public static function sign($str,$sha1_key) {
        return base64_encode(hash('sha256',$str.$sha1_key));
    }

    //排序
    public static function sort_array($data){
        ksort($data);
        $str = "";
        end($data);
        $last_key = key($data);
        if(!empty($data)){
            foreach($data as $key=>$value){
                if($key == $last_key){
                    $str .= $key."=".$value;
                }
                else
                    $str .= $key."=".$value."&";
            }
        }
        return $str;
    }

    //异步通知返回
    public static function default_curl($data){

        $https_url = self::$url;
        echo $https_url;
        $PASS_KEYS   ="123456";
        $timeout = 20;
        $time = time();
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$https_url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        //curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        //curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        ///curl_setopt($ch, CURLOPT_SSLCERT, $pem);
        //curl_setopt($ch, CURLOPT_SSLCERTPASSWD, $PASS_KEYS);

        // $str_p = http_build_query($data);
        $headers = array(
            "Content-type: application/json",
            "Content-Length: ".strlen($data)
        );
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        $output = curl_exec($ch);
        //$test = curl_multi_getcontent($ch);
        $data = json_decode($output,true);
        curl_close($ch);
        print_r($data);
        return $data;   
    }

}
