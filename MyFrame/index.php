<?php
/**
 * 入口文件
 * 1、定义常量
 * 2、加载函数库
 * 3、启动框架
 */
define('PATH',getcwd());//获取当前框架所在的目录
define('CORE',PATH.'/core');//框架核心文件所在的目录
define('APP',PATH.'/app');//项目文件目录：控制器、模型等等
define('MODULE','app');//项目文件目录：控制器、模型等等

define('DEBUG',true);//是否开启调试模式

if(DEBUG) {
    ini_set('display_error','On');
}else{
    ini_set('display_error','Off');
}

include CORE.'/common/function.php';//加载函数库
include CORE.'/core.php';//加载核心文件
spl_autoload_register('\core\core::load');//当我们new的类不存在的时候它会出发这个load方法  自动调用类
\core\core::run();