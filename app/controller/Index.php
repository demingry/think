<?php

namespace app\controller;

use app\BaseController;
use think\facade\View;
use think\facade\Request;

class Index extends BaseController
{
    public function index()
    {
        $name = Request::param('name');
        View::assign(['name'=>$name]);
        return View::fetch();
    }
}
