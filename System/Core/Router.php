<?php
/**
 * Created by PhpStorm.
 * User: yeyeq
 * Date: 2017/11/9
 * Time: 11:19
 */
class Router
{
    public $control_name;
    public $method_name;

    public $default_control;
    public $default_method;


    //query_string部分做路由
    protected $enable_query_string = false;
    function __construct()
    {
        $this->uri = load_class('Uri', 'core');
        //uri这个类来处理uri，如果没有path_info或者query_string,那代表我们用默认的控制器和方法，如果我们提供了uri，那么我们得对uri进行解析，拿到控制器和方法！
        $this->set_router();
    }
    
    function set_router()
    {
        $config = get_config('router');
        $this ->default_control = $config['default_control'];
        $this ->default_method = $config['default_method'];
        //走了uri
        if($this->uri->uri_string != ''){
            $this->set_route_uri();
        } else{
            $this->set_default_route();
        }
    }
    
    public function set_route_uri()
    {
        //拿uri->segment数组！！
        $uri = $this->uri->segments;
        if(isset($uri[0])){
            $this->set_control($uri[0]);
        }
        if(isset($uri[1])){
            $this->set_method($uri[1]);
        } else{
            $this->set_method($this->default_method);
        }
    }
    
    public function set_default_route()
    {
        if($this->default_control)
            $this->set_control($this->default_control);
        if($this->default_control)
            $this->set_method($this->default_method);
    }

    function set_control($control)
    {
        $this->control_name = $control;
    }

    function set_method($method)
    {
        $this->method_name = $method;
    }

}