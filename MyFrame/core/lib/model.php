<?php
namespace core\lib;
class model extends \PDO
{
    public function __construct()
    {
        $database = config::all('database');
        try {//如果连接数据库异常，就显示错误信息
            parent::__construct($database['DSN'],$database['USERNAME'],$database['PASSWD']);
        } catch (\PDOException $e) {
            p($e->getMessage());
        }
    }
}