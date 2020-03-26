<?php

namespace App\Admin\Controllers;

use App\Models\Link;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use DB;

class LinksController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '友链管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        admin_warning('提醒', '最多发布三条友情链接&一条备案信息');
        $grid = new Grid(new Link());
        if (Admin::user()->isAdministrator()) {//权限控制
            $grid->column('id', __('链接编号'));
            $grid->column('link', __('链接'));
            $grid->column('link_name', __('链接名'));
            $grid->column('sort',__('分类'));
            $grid->status('审核状态')->display(function ($status){
                if ($status==1){
                    return $status='<span style="color: green;font-weight: bold">'.'审核通过'. '</span>';
                }elseif ($status == 2){
                    return $status='<span style="color: red;font-weight: bold">'.'审核不通过'. '</span>';
                }else {
                    return $status='<span style="color: darkred;font-weight: bold">代审核</span>';
                }
            });
            $grid->release('发布状态')->display(function ($release){
                if ($release==1){
                    return $release='<span style="color: green;font-weight: bold">'.'已发布'. '</span>';
                }
                else {
                    return $release='<span style="color: darkred;font-weight: bold">未发布</span>';
                }
            });
            $grid->column('created_at', __('创建时间'))->date('Y-m-d H:i:s');
            $grid->column('updated_at', __('更新时间'))->date('Y-m-d H:i:s');
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableView();// 隐藏查看按钮
            });
        }
        else if(Admin::user()->isRole('驾校管理员')) {
            $grid->column('id', __('链接编号'));
            $grid->column('link', __('链接'));
            $grid->column('link_name', __('链接名'));
            $grid->column('sort',__('分类'));
            $grid->status('审核状态')->display(function ($status){
                if ($status==1){
                    return $status='<span style="color: green;font-weight: bold">'.'审核通过'. '</span>';
                }elseif ($status == 2){
                    return $status='<span style="color: red;font-weight: bold">'.'审核不通过'. '</span>';
                }else {
                    return $status='<span style="color: darkred;font-weight: bold">代审核</span>';
                }
            });
            $grid->release('发布状态')->display(function ($release){
                if ($release==1){
                    return $release='<span style="color: green;font-weight: bold">'.'已发布'. '</span>';
                }
                else {
                    return $release='<span style="color: darkred;font-weight: bold">未发布</span>';
                }
            });
            $grid->column('created_at', __('创建时间'))->date('Y-m-d H:i:s');
            $grid->column('updated_at', __('更新时间'))->date('Y-m-d H:i:s');
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableView();// 隐藏查看按钮
            });
        }
        else if(Admin::user()->isRole('运营')){
            $grid->column('id', __('链接编号'));
            $grid->column('link', __('链接'));
            $grid->column('link_name', __('链接名'));
            $grid->column('sort',__('分类'));
            $grid->status('审核状态')->display(function ($status){
                if ($status==1){
                    return $status='<span style="color: green;font-weight: bold">'.'审核通过'. '</span>';
                }elseif ($status == 2){
                    return $status='<span style="color: red;font-weight: bold">'.'审核不通过'. '</span>';
                }else {
                    return $status='<span style="color: darkred;font-weight: bold">代审核</span>';
                }
            });
            $grid->release('发布状态')->display(function ($release){
                if ($release==1){
                    return $release='<span style="color: green;font-weight: bold">'.'已发布'. '</span>';
                }
                else {
                    return $release='<span style="color: darkred;font-weight: bold">未发布</span>';
                }
            });
            $grid->column('created_at', __('创建时间'))->date('Y-m-d H:i:s');
            $grid->column('updated_at', __('更新时间'))->date('Y-m-d H:i:s');
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableView();// 隐藏查看按钮
            });
        }
        return $grid;
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Link());
        if (Admin::user()->isAdministrator()) {//权限控制
            $form->text('link', __('链接'));
            $form->text('link_name', __('链接名'));
            $form->select('sort', __('分类'))->options(['友情链接'=>'友情链接','备案信息'=>'备案信息']);
            $status = [
                'on'  => ['value' => 1, 'text' => '通过', 'color' => 'success'],
                'off' => ['value' => 2, 'text' => '不通过', 'color' => 'danger'],
            ];
            $form->switch('status', __('审核状态'))->states($status);
            $count = DB::table('link')->where('release',1)->where('sort','友情链接')->count();
            if ($count == 3){
                $release = [
                    'on'  => ['value' => 1, 'text' => '发布', 'color' => 'success'],
                    'off' => ['value' => 2, 'text' => '不发布', 'color' => 'danger'],
                ];
                $form->switch('release', __('发布状态'))->states($release)->disable()->help('已达到发布上限');
            }
            else{
                $release = [
                    'on'  => ['value' => 1, 'text' => '发布', 'color' => 'success'],
                    'off' => ['value' => 2, 'text' => '不发布', 'color' => 'danger'],
                ];
                $form->switch('release', __('发布状态'))->states($release);
            }

        }
        else if(Admin::user()->isRole('驾校管理员')) {
            $form->text('link', __('链接'));
            $form->text('link_name', __('链接名'));
            $form->select('sort', __('分类'))->options(['友情链接'=>'友情链接','备案信息'=>'备案信息']);
            $status = DB::table('link')->value('status');
            if ($status == 1){
                $count = DB::table('link')->where('release',1)->where('sort','友情链接')->count();
                if ($count == 3){
                    $release = [
                        'on'  => ['value' => 1, 'text' => '发布', 'color' => 'success'],
                        'off' => ['value' => 2, 'text' => '不发布', 'color' => 'danger'],
                    ];
                    $form->switch('release', __('发布状态'))->states($release)->disable()->help('已达到发布上限');
                }
                else{
                    $release = [
                        'on'  => ['value' => 1, 'text' => '发布', 'color' => 'success'],
                        'off' => ['value' => 2, 'text' => '不发布', 'color' => 'danger'],
                    ];
                    $form->switch('release', __('发布状态'))->states($release);
                }
            }else{
                $release = [
                    'on'  => ['value' => 1, 'text' => '发布', 'color' => 'success'],
                    'off' => ['value' => 2, 'text' => '不发布', 'color' => 'danger'],
                ];
                $form->switch('release', __('发布状态'))->states($release)->disable()->help('链接未审核');
            }
        }
        else if(Admin::user()->isRole('运营')) {
            $form->text('link', __('链接'));
            $form->text('link_name', __('链接名'));
            $form->select('sort', __('分类'))->options(['友情链接'=>'友情链接','备案信息'=>'备案信息']);
            $status = DB::table('link')->value('status');
            if ($status == 1){
                $count = DB::table('link')->where('release',1)->where('sort','友情链接')->count();
                if ($count == 3){
                    $release = [
                        'on'  => ['value' => 1, 'text' => '发布', 'color' => 'success'],
                        'off' => ['value' => 2, 'text' => '不发布', 'color' => 'danger'],
                    ];
                    $form->switch('release', __('发布状态'))->states($release)->disable()->help('已达到发布上限');
                }
                else{
                    $release = [
                        'on'  => ['value' => 1, 'text' => '发布', 'color' => 'success'],
                        'off' => ['value' => 2, 'text' => '不发布', 'color' => 'danger'],
                    ];
                    $form->switch('release', __('发布状态'))->states($release);
                }
            }else{
                $release = [
                    'on'  => ['value' => 1, 'text' => '发布', 'color' => 'success'],
                    'off' => ['value' => 2, 'text' => '不发布', 'color' => 'danger'],
                ];
                $form->switch('release', __('发布状态'))->states($release)->disable()->help('链接未审核');
            }

        }
        return $form;
    }
}
