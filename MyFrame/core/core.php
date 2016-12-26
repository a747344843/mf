<?php

namespace core;
use core\lib\log;
use core\lib\route;
class core
{
    public $data;
    //防止重复引用类
    public static $classMap = array();
    static public function run()
    {
        log::init();
        log::log($_SERVER,'server');
        $route = new route();//实例化路有类
        $controller = $route->ctrl;//获取控制器名
        $action     = $route->action;//获取方法名
        $ctrlfile = APP.'/controllers/'.ucfirst($controller).'Controller.php';//控制器文件路径
        $ctrlClass = '\\'.MODULE.'\controllers\\'.ucfirst($controller).'Controller';
        if(is_file($ctrlfile)){//验证这个文件是否存在
            include $ctrlfile;//包含控制器文件
            $ctrl = new $ctrlClass();//实例化控制器
            $ctrl->$action();//调用方法
        } else {
            throw new \Exception('找不到控制器'.$ctrlfile);
        }
    }

    //自动加载类库
    static public function load($class)
    {
        //echo 123;
        //判断$classMap中是否有这个类
        if(isset($classMap[$class])){
            return true;
        } else {
            $class = str_replace('\\','/',$class);
            $file = PATH.'/'.$class.'.php';
            //判断这个文件是否存在
            if(is_file($file)) {
                include $file;
                //如果引入成功的话，就放到$classMap数组中
                self::$classMap[$class] = $class;
            } else {
                return false;
            }
        }
    }

    //调用视图
    public function view($view,$data = '')//接收视图和值
    {
        $view = APP.'/views/'.$view.'.php'; //视图路径
        if(is_file($view)) {//验证视图是否是一个文件

            if($data != '') {//验证有没有传值过来
                foreach($data as $k => $v) {
                    $this->data[$k] = $v;
                }
                extract($this->data);//把数组打散，把每一个数组中的键值变为一个变量
            }

            include $view;//包含视图文件
        }
    }
}