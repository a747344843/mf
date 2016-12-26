<?php
namespace core\lib\drive\log;
//日志存在文件系统中
use core\lib\config;

class file
{
    public $path;//日志存储位置
    public function __construct()
    {
        $conf = config::get('OPTION','log');
        $this->path = $conf['PATH'];
    }
    public function log($message,$file = 'log')
    {
        /**
         * 1、确定文件的存储位置是否存在
         * 新建目录
         * 2、写入日志
         */
        p($this->path);
        if(!is_dir($this->path)) {
            mkdir($this->path,'0777',true);
        }

        file_put_contents($this->path.$file.'.php',date('y-m-d H:i:s').json_encode($message).PHP_EOL,FILE_APPEND);
    }
}