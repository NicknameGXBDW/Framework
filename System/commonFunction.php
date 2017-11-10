<?php
/**
 * Created by PhpStorm.
 * 自定义公共函数库
 * User: yeyeq
 * Date: 2017/11/9
 * Time: 10:00
 */

//获取控制器实例，是单例模式
function get_instance()
{
    return controll::get_instance();
}



/**
 * 加载并实例指定目录的类,单例模式
 * parameter string  $class_name  类名
 * parameter string  $dir         目录名 默认为Core（核心）
 * parameter string  $parameter   实例时附带的参数
 * return    object  this obj is a instance of class that load
*/
function load_class($class_name, $dir = 'Core', $parameter ="") {
    
    static $is_loaded = array();
    $class_check = $dir.'_'.$class_name;
    // 这样写会报告说没有发现$class_check这个数组下标
    //    if($is_loaded[$class_check]){
    //        echo '已经实例化过了';
    //        return $is_loaded[$class_check];
    //    }

    if(isset($is_loaded[$class_check])){
        echo '已经实例化过了';
        return $is_loaded[$class_check];
    }


    $class_path = SYS_PATH.DIRECTORY_SEPARATOR.$dir.DIRECTORY_SEPARATOR.$class_name.'.php';
    require_once($class_path);
    $class = $parameter ? $class_name($parameter) : $class_name;
    $is_loaded[$class_check] = new $class;
    
    return $is_loaded[$class_check];
};

/**
 * 
 * @param string $config_file_name
 */
function get_config($config_file_name){
    //暂时用相对路径
    $config_file = APP_PATH.DIRECTORY_SEPARATOR.'Config'.DIRECTORY_SEPARATOR.$config_file_name.".php";
    if(file_exists($config_file)){
        include $config_file;
        return $config;
    }
}

