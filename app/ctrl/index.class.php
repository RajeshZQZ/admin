<?php

/**
 * Created by PhpStorm.
 * User: zengqingzhang
 * Date: 2018/9/6
 * Time: 15:17
 */
class ctrl_index
{
/*主页
*/

public function main (){
    echo "<h1 align='center'>欢迎来到Rajesh.z的主页~!</h1>";
    include_once (TEMPLATE.'woman.html');
}


}