<?php
class framework_base_autoloader
{
    public static $loader;
    /**
     * 构造函数
     */
    private function __construct()
    {
        spl_autoload_register("import");
     //   spl_autoload_register("loadCtrl");
      //  spl_autoload_register("loadModel");
    }
/*
    function loadCtrl($classname){
        $filename = CTRL_DIR.$classname.'class.php';
        if (file_exists($filename)){
            require $filename;
        }
    }
*/
    public static function init()
    {
        // 静态化自调用
        if (self::$loader == NULL)
            self::$loader = new self();

        return self::$loader;
    }

    /**
     * 固定路径的class 类文件 以.class.php 结尾
     * ctrl_index
     */
    function import($className)
    {

        $path = array();
        $pathDir = '';
        $path = explode('_', $className);

        /*$className=ctrl_index;
        $path=array('ctrl','index');
        $arrCount = 2;
        $pathDir = ctrl/index
        ctrl/payment/shijijy/index
        */
        $arrCount = count($path);
        $pathDir = implode('/', array_slice($path, 0, $arrCount));

      //  spl_autoload_extensions('.class.php');
      //  spl_autoload($pathDir . "/" . $path[$arrCount])
        //  /usr/local/httpd/htdocs/game01/admin/app/ctrl/index.class.php

        $filename = APP_DIR.$classname.'class.php';
        if (file_exists($filename)){
            require $filename;
        }
    }
}