<?php

namespace App\Admin\Controllers;


use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Facades\Admin;
use DB;


class HomeController extends Controller

{
    public function index(Content $content)
    {

        return $content
            ->row(Dashboard::title())
            ->row(function (Row $row) {
                if (Admin::user()->isAdministrator()){
                    $row->column(4, function (Column $column) {
                        $column->append(Dashboard::sex());
                    });

                    $row->column(4, function (Column $column) {
                        $column->append(Dashboard::complete());
                    });
                    $row->column(4, function (Column $column) {
                        $column->append(Dashboard::tongji());
                    });
                    $row->column(4, function (Column $column) {
                        $column->append(admin_toastr('超级管理员</br>欢迎登陆驾校报名预约系统', 'success',['timeOut' => 1500]));
                    });
                }
                else if(Admin::user()->isRole('驾校管理员')){
                    $row->column(4, function (Column $column) {
                        $column->append(Dashboard::complete1());
                    });
                    $row->column(4, function (Column $column) {
                        $column->append(Dashboard::tongji1());
                    });
                    $row->column(4, function (Column $column) {
                        $column->append(Dashboard::tongji1());
                    });
                    $row->column(4, function (Column $column) {
                        $column->append(admin_toastr('驾校管理员<br>欢迎登陆驾校报名预约系统', 'success',['timeOut' => 1500]));
                    });

                }
                else if(Admin::user()->isRole('教练员')){
                    $row->column(5, function (Column $column) {
                        $column->append(Dashboard::complete2());
                    });
                    $row->column(4, function (Column $column) {
                        $column->append(Dashboard::tongji2());
                    });
                    $row->column(4, function (Column $column) {
                        $column->append(admin_toastr('教练员<br>欢迎登陆驾校报名预约系统', 'success',['timeOut' => 1500]));
                    });
                }
            });
    }
}



