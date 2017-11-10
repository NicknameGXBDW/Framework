<?php
/**
 * Created by PhpStorm.
 * User: yeyeq
 * Date: 2017/11/9
 * Time: 10:26
 */
class Control
{
    //忘记加static了
    private static $instance;
    
    public function __construct()
    {
        self::$instance = $this;
        //实例loader类
        $this->load = load_class('Loader');
    }
    
    static function get_instance(){
        return self::$instance;
    }
    
}