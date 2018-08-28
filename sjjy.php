<?php
/**
 * Created by JetBrains PhpStorm.
 * User: YANGMANYAN784
 * Date: 18-4-17
 * Time: 下午3:18
 * To change this template use File | Settings | File Templates.
 */

class ctrl_sjjy extends ctrl_base {
    const APP_SECRET = "12f03456079a4e208ab2bb44183564f5" ;//秘钥
    const URL = "http://10test90-wap.stg3.1768.com/shijijy_notify.php";
    //curl "http://caipiaoapi9.stg3.24cp.com/?act=sjjy&st=call_back&orderId=&openId=&amount=&feeAmount="
    public static function call_back(){
        $memcache = new framework_base_memcached();
        $memKey = 'shijijiayuan:youximocktest:sjjy:order_id:'.$_GET['orderId'];
        $memRes = $memcache->get_cache($memKey);
        if(!empty($memRes)){
            $sjjy_order = $memRes;
        }else{

            $sjjy_order = array("order_id"=>$_GET['orderId'],
                                "openid" => $_GET['openId'],
                                "amount" => $_GET['amount'],
                                "fee_amount" => $_GET['feeAmount']
                               );
            $addSucc = $memcache->save_cache($memKey,$sjjy_order,'',1200);
            if(!$addSucc){
                echo "订单缓存保存失败！";
                exit;
            }
        }
        $data = array("cporderid"=>$sjjy_order['order_id'],
            "openid"=>$sjjy_order['openid'],
            "reqDate"=>date("Y-m-d H:i:s",time()),
            "timestamp"=>time(),
            "amount"=>$sjjy_order['amount'],
            "fee_amount"=>$sjjy_order['fee_amount'],
            "real_amount"=>$sjjy_order['amount']-$sjjy_order['fee_amount'],
            "fee_rate"=>round($sjjy_order['fee_amount']/$sjjy_order['amount'],2)
        );
        $data_str = self::sort_array($data);

        $request = array("result"=>self::encrypt($data_str),
            "sign"=>self::sign($data_str,self::APP_SECRET)
        );
        $request_json = json_encode($request);
        self::default_curl($request_json);

    }

    public static function call_sjjy(){
        $memcache = new framework_base_memcached();
        $memKey = 'shijijiayuan:youximocktest:sjjy:order_id:'.$_POST['orderId'];
        $memRes = $memcache->get_cache($memKey);
        if(empty($memRes)){
            echo "订单信息获取失败！";
            exit;
        }
        framework_static_function::write_log('世纪佳缘反查数据:'.$memRes, yang_sjjy);
        $sjjy_order = $memRes;

        $response = array("code"=>0, //0成功 1失败
                "message"=>"success",
                "orderId"=>$sjjy_order['order_id'],
                "open_id"=> $sjjy_order['openid'],
                "order_date"=>date("Y-m-d H:i:s",time()-300),
                "timestamp"=>time(),
                "amount"=>$sjjy_order['amount'],
									"fee_amount"=> $sjjy_order['fee_amount'],
									"real_amount"=>$sjjy_order['amount']-$sjjy_order['fee_amount'],
									"fee_rate"=>round($sjjy_order['fee_amount']/$sjjy_order['amount'],2),
									"callback_status"=>0,//0未通知到合作方，1已通知到合作方，2通知失败
									"callback_time"=>time()-200 //仅当callback_status为1时有效
									
             );
		echo json_encode($response);

	}



    public static function encrypt($data){
        $key_len = 1024;
        $max = ($key_len / 8) - 11;

        $encrypted = "";
        $encrypted_str = "";

        $pubkey = file_get_contents("http://caipiaoapi9.stg3.24cp.com/rsa_private_key.pem");

        $len = ceil(strlen($data)/$max);
        for ($i=0; $i<$len ; $i++) {
            $tmp = substr($data, $i*$max, $max);
            openssl_private_encrypt($tmp, $encrypted, $pubkey, OPENSSL_PKCS1_PADDING);
            $encrypted_str .= $encrypted;
            $encrypted = '';
        }
        return base64_encode($encrypted_str);
    }

    public static function sign($str,$sha1_key) {
        return base64_encode(hash('sha256',$str.$sha1_key));
	}

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

    public static function default_curl($data){

        $https_url = self::URL;
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
