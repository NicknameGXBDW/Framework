<?php
/**
 * Created by PhpStorm.
 * User: yeyeq
 * Date: 2017/11/9
 * Time: 10:58
 */
class Loader
{
    function __construct()
    {
    }
    
    function model()
    {
        
    }
    
    function load($class, $dir='Core', $para="")
    {
        //获取控制器实例
        $ctr = get_instance();
        //引入类文件
        require SYS_PATH.DIRECTORY_SEPARATOR.$dir.DIRECTORY_SEPARATOR.$class.'.php';
        //实例
        $ctr -> $class = new $class();
        // 给控制器类属性拿来用
        return $ctr -> $class; 
    }
}