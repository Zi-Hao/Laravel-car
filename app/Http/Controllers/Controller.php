<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use App\Models\Link;
use Illuminate\Support\Facades\View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct()
    {
        //声明全局模板
        View::share('links', $this->Links());
        View::share('bei', $this->bei());
    }
    /**
     * 获取配置文件
     */
    public function Links()
    {
        return Link::query()->where('status',1)->where('release',1)->where('sort','友情链接')->limit(3)->get();
    }

    public function bei()
    {
        return Link::query()->where('status',1)->where('release',1)->where('sort','备案信息')->limit(1)->get();
    }
}
