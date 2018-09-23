<?php

        spl_autoload_register("import");
    /**
     * 固定路径的class 类文件 以.class.php 结尾
     * ctrl_index
     */
    function import($className)
    {
//echo "import_classname:".$className."</br>";
        $path = array();
        $pathDir = '';
        $path = explode('_', $className);
        $arrCount = count($path);
        $pathDir = implode('/', array_slice($path, 0, $arrCount));
        $filename = APP_DIR.$pathDir.'.class.php';
//echo "filename:".$filename."</br>";
        if (file_exists($filename)){
	  require $filename;
        }
    }
