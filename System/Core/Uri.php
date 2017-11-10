<?php
/**
 * Created by PhpStorm.
 * User: yeyeq
 * Date: 2017/11/9
 * Time: 11:36
 */
class Uri
{

    public $uri_string;

    public $segments =array();
//一个完整的URLhttp://localhost/Framework/test.php/welcome/Index/?m=1&a=3
//var_dump($_SERVER);后可以看到这几个东西
//'QUERY_STRING' => string 'm=1&a=3' (length=7)
//'REQUEST_URI' => string '/Framework/test.php/welcome/Index/?m=1&a=3' (length=42)
//'SCRIPT_NAME' => string '/Framework/test.php' (length=19)
//'PATH_INFO' => string '/welcome/Index/' (length=15)
//根据不同的URL格式进行处理
// PATH_INFO    uri路径部分
// QUERY_STRING  uri ？部分
// AUTO
// REQUEST_URL   全部的uri除去host部分
    
//我们想起 phpcms的uri 是写成 http://my.com/index.php?m=user&c=welcome&a=index的写法，用的是query_string部分来进行解析的
    function __construct()
    {
        $config = get_config('uri');
        $uri_protocol = $config['uri_protocol'];
        switch($uri_protocol){
            case 'request_uri':
                $this->parse_request_uri();
                break;
            case 'query_string':
                $this ->parse_query_string();
                break;
            default:
                $this->parse_request_uri();
                break;
        }
        
    }
    
    function parse_request_uri()
    {
        //注意，如果没有uri相关的，就不能继续往下走，不然会继续
        if ( ! isset($_SERVER['REQUEST_URI'], $_SERVER['SCRIPT_NAME']))
        {
            return '';
        }
        
        $uri = "http://test".$_SERVER['REQUEST_URI'];
        $uri = parse_url($uri);
        $uri = isset($uri['path'])?$uri['path']:'';
        $query = isset($uri['query'])?$uri['query']:'';
        //去掉脚本文件的路径，得到真正的path_info路径
        if($_SERVER['SCRIPT_NAME']){
            $uri = substr($uri,strlen($_SERVER['SCRIPT_NAME']));
        }
        //echo $uri;
        if(trim($uri,'/') == '' && strncmp($query,'/',1) == 0){
            $_arr = explode('?',$query);
            if(isset($_arr[0])){
                $uri = $_arr[0];
            }
            if(isset($_arr[1])){
                parse_str($_arr[1],$_GET[]);
            }
        } else {
            $this->parse_path($uri);
        }
    }

    function parse_query_string(){
        
    }



    function parse_path($uri){
        $_uri = explode('/',ltrim($uri,'/'));
        //var_dump($_uri);
        $segments=array();
        foreach($_uri as $val){
            //要去掉uri人为加的空白空格这些！
            $segments[] = trim($val);
            //其实这里我还少写了函数，过滤uri中非法的字符！！
            //filter malicious character
        }
        $this->segments = $segments;
        $this->uri_string = implode('/',$this->segments);
        //var_dump($this->segments);
    }
}