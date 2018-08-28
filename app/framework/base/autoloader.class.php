<?php
class framework_base_autoloader
{
    public static $loader;

    /**
     * 构造函数
     */
    private function __construct()
    {
        spl_autoload_register(array(
            $this,
            'import'
        ));
    }

    public static function init()
    {
        // 静态化自调用
        if (self::$loader == NULL)
            self::$loader = new self();

        return self::$loader;
    }

    /**
     * 固定路径的class 类文件 以.class.php 结尾
     */
    protected function import($className)
    {

        $path = array();
        $pathDir = '';
        $path = explode('_', $className);

        /*$className=ctrl_payment_shijijy_index;
        $path=array('ctrl','payment','shijijy','index');
        $arrCount = 3;
        $pathDir = ctrl/payment/shijijy/index.class.php;
        */
        $arrCount = count($path) - 1;
        $pathDir = implode('/', array_slice($path, 0, $arrCount));
        spl_autoload_extensions('.class.php');
        spl_autoload($pathDir . "/" . $path[$arrCount]);
    }
}