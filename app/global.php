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

   	   // $appPath = ACT_PATH . $_REQUEST['act'] . '.class.php';
    	$className = 'ctrl_' . $_REQUEST['act']; /* 类名 */
    	//ctrl_index
     if ( !class_exists( $className ) ) {
    	echo "11111";
         exit;
         //header( 'HTTP/1.1 404 Not Found' );
    //	die;
        }
       $obj = new $className();
       runAction($obj);
    }

	 function runAction($obj)
	{
	    if (!method_exists($obj, $_REQUEST['st'])) {
	      echo "222222";
	        //  header( 'HTTP/1.1 404 Not Found' );
	       // exit;
	//        header('Content-Type:text/html;charset=utf-8');
	//        die('错误，方法不存在');
	    }
	    $obj->$_REQUEST['st']();
	}