<?php
/**
 * Created by PhpStorm.
 * 前台入口文件
 */
//header('charset', 'utf-8');
//准备工作 定义几个常量

define('APP_DIR', 'Application');
define('SYS_DIR', 'System');

//检测是否存在这个文件夹
if(realpath(APP_DIR) == false || realpath(APP_DIR) == false){
    header('HTTP/1.1 503 Service Unavailable.', TRUE, 503);
    echo "系统中不存在预定义的文件夹Application和System";
    //异常退出
    exit(3);
}

define('APP_PATH',realpath(APP_DIR));
define('SYS_PATH',realpath(SYS_DIR));
define('SELF', pathinfo(__FILE__, PATHINFO_BASENAME));
//开发环境,默认为开发
$environment = 'development';
//echo SYS_PATH.DIRECTORY_SEPARATOR.'Core'.DIRECTORY_SEPARATOR.'bootstrap.php';
require_once(SYS_PATH.DIRECTORY_SEPARATOR.'Core'.DIRECTORY_SEPARATOR.'bootstrap.php');