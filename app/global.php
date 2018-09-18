<?php

	function doAction()
	{
   	 if (!isset($_REQUEST['act'])) {
        /*  默认执行首页 */
        $_REQUEST['act'] = 'index';
    	}
     if (!isset($_REQUEST['st'])) {
        /* 默认执行 Index 方法 */
        $_REQUEST['st'] = 'main';
        }

    	$className = 'ctrl_' . $_REQUEST['act']; /* 类名 */
echo 'doaction_classname:'.$className."</br>";
     if (!class_exists($className)){
    	die('not this class');
      }
       $obj = new $className();
	runAction($obj);
  }

	 function runAction($obj)
	{
	    if (!method_exists($obj, $_REQUEST['st'])) {
	       die('错误，方法不存在');
	    }
	  $a = $_REQUEST['st'];
	  $obj->$a();
	}


/**
 * 创建文本日志

public function sendLogs($val, $col='url'){
    $path = APP_DIR."/logs";
    echo $path;
    $time = date('Y-m-d h:i:s',time());
    $file = $path."/"."send.txt";
    $fp = fopen($file,"a+");
    //$val['url'] = $col;
    $content ="";
    $start="time:".$time."\r\n"."url/ip:".$col."\r\n"."---------- content start ----------"."\r\n";
    $end ="\r\n"."---------- content end ----------"."\r\n\n";
    if (is_array($val)){
        foreach ($val as $k=>$v ){
            $content = $content."/".$k.":".$v;
    }else{
            $content = $val;
    }
    }
    $content=$start.$content.$end;
    fwrite($fp,$content);
    fclose($fp);
}

 */

