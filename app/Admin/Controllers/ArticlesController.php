<?php

namespace App\Admin\Controllers;

use App\Models\Article;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use DB;

class ArticlesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '图文管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Article());
        if(Admin::user()->isAdministrator()) {
            $grid->column('id', __('文章编号'));
            $grid->column('name', __('作者'));
            $grid->column('title', __('标题'));
            $grid->column('sort', __('类别'));
            $grid->status('审核状态')->display(function ($status){
                if ($status==1){
                    return $status='<span style="color: green;font-weight: bold">'.'审核通过'. '</span>';
                }elseif ($status == 2){
                    return $status='<span style="color: red;font-weight: bold">'.'审核不通过'. '</span>';
                }else if($status==0){
                    return $status='<span style="color: darkred;font-weight: bold">代审核</span>';
                }
            });
            $grid->release('发布状态')->display(function ($release){
                if ($release==1){
                    return $release='<span style="color: green;font-weight: bold">'.'已发布'. '</span>';
                }elseif ($release == 2){
                    return $release='<span style="color: red;font-weight: bold">'.'未发布'. '</span>';
                }else if($release==0){
                    return $release='<span style="color: darkred;font-weight: bold">未发布</span>';
                }
            });
            $grid->column('created_at', __('创建时间'))->date('Y-m-d H:i:s');
            $grid->column('updated_at', __('更新时间'))->date('Y-m-d H:i:s');
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableView();// 隐藏查看按钮
            });
        }
        else if (Admin::user()->isRole('驾校管理员')){
            $grid->column('id', __('文章编号'));
            $grid->column('name', __('作者'));
            $grid->column('title', __('标题'));
            $grid->column('sort', __('类别'));
            $grid->status('审核状态')->display(function ($status){
                if ($status==1){
                    return $status='<span style="color: green;font-weight: bold">'.'审核通过'. '</span>';
                }elseif ($status == 2){
                    return $status='<span style="color: red;font-weight: bold">'.'审核不通过'. '</span>';
                }else if($status==0){
                    return $status='<span style="color: darkred;font-weight: bold">代审核</span>';
                }
            });
            $grid->release('发布状态')->display(function ($release){
                if ($release==1){
                    return $release='<span style="color: green;font-weight: bold">'.'已发布'. '</span>';
                }elseif ($release == 2){
                    return $release='<span style="color: red;font-weight: bold">'.'未发布'. '</span>';
                }else if($release==0){
                    return $release='<span style="color: darkred;font-weight: bold">未发布</span>';
                }
            });
            $grid->column('created_at', __('创建时间'))->date('Y-m-d H:i:s');
            $grid->column('updated_at', __('更新时间'))->date('Y-m-d H:i:s');
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableView();// 隐藏查看按钮
            });
        }
        else if (Admin::user()->isRole('运营')){
            $grid->column('id', __('文章编号'));
            $grid->column('name', __('作者'));
            $grid->column('title', __('标题'));
            $grid->column('sort', __('类别'));
            $grid->status('审核状态')->display(function ($status){
                if ($status==1){
                    return $status='<span style="color: green;font-weight: bold">'.'审核通过'. '</span>';
                }elseif ($status == 2){
                    return $status='<span style="color: red;font-weight: bold">'.'审核不通过'. '</span>';
                }else if($status==0){
                    return $status='<span style="color: darkred;font-weight: bold">代审核</span>';
                }
            });
            $grid->release('发布状态')->display(function ($release){
                if ($release==1){
                    return $release='<span style="color: green;font-weight: bold">'.'已发布'. '</span>';
                }elseif ($release == 2){
                    return $release='<span style="color: red;font-weight: bold">'.'未发布'. '</span>';
                }else if($release==0){
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
        $form = new Form(new Article());
        if(Admin::user()->isAdministrator()) {
            $form->text('name', __('作者'))->default(Admin::user()->name)->disable();
            $form->text('title', __('标题'))->required();
            $form->cropper('image',__('封面图'))->cRatio(400,300);
            $form->textarea('survey', __('简介'))->help('展示在浏览页,限制100字')->rules('required|max:220');
            $form->simditor('content', __('内容'))->help('图片大小不得超过100K')->required();
            $form->select('sort', __('分类'))->options(['驾校简介'=>'驾校简介','驾校文章'=>'驾校文章']);
            $states = [
                'on'  => ['value' => 1, 'text' => '通过', 'color' => 'success'],
                'off' => ['value' => 2, 'text' => '不通过', 'color' => 'danger'],
            ];
            $form->switch('status', __('审核状态'))->states($states);
            $release = [
                'on'  => ['value' => 1, 'text' => '发布', 'color' => 'success'],
                'off' => ['value' => 2, 'text' => '不发布', 'color' => 'danger'],
            ];
            $form->switch('release', __('发布状态'))->states($release);
        }
        else if (Admin::user()->isRole('驾校管理员')){
            $form->text('name', __('作者'))->required();
            $form->text('title', __('标题'))->required();
            $form->cropper('image',__('封面图'))->cRatio(300,300);
            $form->textarea('survey', __('简介'))->help('展示在浏览页,限制100字')->rules('required|max:220');
            $form->simditor('content', __('内容'))->help('图片大小不得超过100K')->required();
            $form->select('sort', __('分类'))->options(['驾校简介'=>'驾校简介','驾校文章'=>'驾校文章']);
            $states = [
                'on'  => ['value' => 1, 'text' => '通过', 'color' => 'success'],
                'off' => ['value' => 2, 'text' => '不通过', 'color' => 'danger'],
            ];
            $form->switch('status', __('审核状态'))->states($states);
            $release = [
                'on'  => ['value' => 1, 'text' => '发布', 'color' => 'success'],
                'off' => ['value' => 2, 'text' => '不发布', 'color' => 'danger'],
            ];
            $form->switch('release', __('发布状态'))->states($release);
        }
        else if (Admin::user()->isRole('运营')){
            $form->text('name', __('作者'))->required();
            $form->text('title', __('标题'))->required();
            $form->cropper('image',__('封面图'))->cRatio(300,300);
            $form->textarea('survey', __('简介'))->help('展示在浏览页,限制100字')->rules('required|max:220');
            $form->simditor('content', __('内容'))->help('图片大小不得超过100K')->required();
            $form->select('sort', __('分类'))->options(['驾校简介'=>'驾校简介','驾校文章'=>'驾校文章']);
            $states = [
                'on'  => ['value' => 1, 'text' => '通过', 'color' => 'success'],
                'off' => ['value' => 2, 'text' => '不通过', 'color' => 'danger'],
            ];
            $form->switch('status', __('审核状态'))->states($states)->disable();
            $release = [
                'on'  => ['value' => 1, 'text' => '发布', 'color' => 'success'],
                'off' => ['value' => 2, 'text' => '不发布', 'color' => 'danger'],
            ];
            $form->switch('release', __('发布状态'))->states($release);
        }



        return $form;
    }
}
