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
