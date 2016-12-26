<?php
namespace core\lib;
class route
{
    public $ctrl;
    public $action;
    public function __construct()
    {
        /**
         * 1、获取URL中参数
         * 2、返回对应控制器和方法
         */
        $url = $_SERVER['REQUEST_URI'];
        if(isset($url) && $url != '/') {
            $path =  explode('/',substr($url,strpos($url,'/?c=')+4));
            if(isset($path[0])){
                $this->ctrl = $path[0];
            }
            if(isset($path[1])){
                $this->action = $path[1];
            } else {
                $this->action = config::get('ACTION','route');
            }
        } else {
            $this->ctrl = config::get('CONTROLLER','route');
            $this->action = config::get('ACTION','route');
        }

    }
}