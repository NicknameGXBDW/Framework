<?php
/**
 * Created by PhpStorm.
 * User: yeyeq
 * Date: 2017/11/9
 * Time: 10:03
 */
defined('SYS_PATH') OR exit('No direct script access allowed');

require_once SYS_PATH.DIRECTORY_SEPARATOR.'commonFunction.php';
require_once SYS_PATH.DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.'Control.php';

//路由实例
$Router = load_class('Router', 'Core');
// 拿到控制器和方法
var_dump($Router);
$_control = $Router->control_name;
$method = $Router->method_name;
echo $_control;
echo $method;
echo "<br/>";
echo ucfirst($_control);

//控制器文件如果找不到，以及方法不存在，跳转到一个错误页面
$error_404 = false;
if(!empty($_control)){
    if(file_exists(APP_PATH.DIRECTORY_SEPARATOR.'Control'.DIRECTORY_SEPARATOR.$_control.'.php')){
        include APP_PATH.DIRECTORY_SEPARATOR.'Control'.DIRECTORY_SEPARATOR.$_control.'.php';
        echo APP_PATH.DIRECTORY_SEPARATOR.'Control'.DIRECTORY_SEPARATOR.$_control.'.php';
        $control = ucfirst($_control);
        echo $control;
    }else{
        $error_404 = true;
    }
}else{
    $error_404 = true;
}

if($error_404)
{
    echo "页面未找到！";
}

$CI = new $control();

var_dump($CI);
call_user_func_array(array($CI, $method),$params);
