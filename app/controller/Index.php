<?php

namespace app\controller;

use app\BaseController;
use think\facade\View;
use think\facade\Request;
use Util\data\Sysdb;
use think\facade\Db;

class Index extends BaseController
{
    public function index($name=''){
        $name = Request::param('name');
        View::assign(['name'=>$name]);
        return View::fetch();
    }

    public function testdb(Sysdb $handler){
        $name = $handler->table('test_table')->where(['id'=>1])->item();
        dump($name);
    }
}
