<?php

namespace App\Admin\Controllers;

use App\Models\Coach;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use DB;

class CoachesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '教练管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Coach());

        if (Admin::user()->isAdministrator()) {

            $grid->column('id', __('教练员编号'));
            $grid->column('name', __('姓名'));
            $grid->column('sex',__('性别'));
            $grid->column('phone', __('电话号码'));
            $grid->column('wechat', __('微信'));
            $grid->status('状态')->display(function ($status){
                if ($status==1){
                    return $status='<span style="color: green;font-weight: bold">'.'通过'. '</span>';
                }elseif ($status == 2){
                    return $status='<span style="color: red;font-weight: bold">'.'未通过'. '</span>';
                }elseif ($status ==0){
                    return $status='<span style="color: deepskyblue;font-weight: bold">'.'审核中'. '</span>';
                }
            });

        }
        else if(Admin::user()->isRole('驾校管理员')){

            $grid->column('id', __('教练员编号'));
            $grid->column('name', __('姓名'));
            $grid->column('sex',__('性别'));
            $grid->column('phone', __('电话号码'));
            $grid->column('wechat', __('微信'));
            $grid->status('状态')->display(function ($status){
                if ($status==1){
                    return $status='<span style="color: green;font-weight: bold">'.'通过'. '</span>';
                }elseif ($status == 2){
                    return $status='<span style="color: red;font-weight: bold">'.'未通过'. '</span>';
                }elseif ($status ==0){
                    return $status='<span style="color: deepskyblue;font-weight: bold">'.'审核中'. '</span>';
                }
            });
            $grid->disableCreateButton();//隐藏新增按钮
            $grid->disableRowSelector();

        }
        else if(Admin::user()->isRole('教练员')){
            $grid->column('id', __('教练员编号'));
            $grid->column('name', __('姓名'));
            $grid->column('sex',__('性别'));
            $grid->column('phone', __('电话号码'));
            $grid->column('wechat', __('微信'));
            $grid->status('状态')->display(function ($status){
                if ($status==1){
                    return $status='<span style="color: green;font-weight: bold">'.'通过'. '</span>';
                }elseif ($status == 2){
                    return $status='<span style="color: red;font-weight: bold">'.'未通过'. '</span>';
                }elseif ($status ==0){
                    return $status='<span style="color: deepskyblue;font-weight: bold">'.'审核中'. '</span>';
                }
            });
            admin_warning('提醒', '教练员请完善个人信息，提交驾校审核');
            $grid->model()->where('name',Admin::user()->name);

            $grid->disableExport();
            $grid->disableCreation();
            $grid->disableFilter();
            $grid->disablePagination();
            $grid->disableRowSelector();
            $grid->disableColumnSelector();
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableDelete();
            });

        }

        $grid->filter(function($filter){
            $filter->disableIdFilter();// 去掉默认的 id 过滤器
            $filter->like('name', '姓名'); // 添加新的字段过滤器（通过姓名过滤）
        });

        return $grid;
    }


    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Coach());

        if (Admin::user()->isAdministrator()) {//判断是否为超级管理员
            $form->display('id', __('教练员编号'));
            $form->text('name', __('姓名'));
            $form->select('sex', __('性别'))->options(['男'=>'男','女'=>'女'])->required();
            $form->mobile('phone', __('电话号码'))->options(['mask' => '999 9999 9999'])->required();
            $form->text('wechat', __('微信'))->required();
            $form->cropper('image',__('封面图'))->cRatio(300,300);
            $form->textarea('survey',__('概述'))->help('展示在浏览页,限制100字')->rules('required|max:220');
            $form->simditor('describe', __('简介'))->help('图片大小不得超过100K')->required();
            $form->fieldset('操作信息', function (Form $form) {
                $states = [
                    'on'  => ['value' => 1, 'text' => '通过', 'color' => 'success'],
                    'off' => ['value' => 2, 'text' => '不通过', 'color' => 'danger'],
                ];
                $form->switch('status', __('审核'))->states($states);
                $form->display('created_at', __('创建时间'));
                $form->display('updated_at', __('修改时间'));
            });

        }
        else if (Admin::user()->isRole('驾校管理员')){//判断是否为驾校管理员


            $form->display('id', __('教练员编号'))->disable();
            $form->text('name', __('姓名'));
            $form->select('sex', __('性别'))->options(['男'=>'男','女'=>'女'])->required();
            $form->mobile('phone', __('电话号码'))->options(['mask' => '999 9999 9999'])->required();
            $form->text('wechat', __('微信'))->required();
            $form->simditor('describe', __('简介'))->help('图片大小不得超过100K');

            $form->fieldset('操作信息', function (Form $form) {
                $states = [
                    'on'  => ['value' => 1, 'text' => '通过', 'color' => 'success'],
                    'off' => ['value' => 2, 'text' => '不通过', 'color' => 'danger'],
                ];
                $form->switch('status', __('审核'))->states($states);
                $form->display('created_at', __('创建时间'));
                $form->display('updated_at', __('修改时间'));
            });

            $form->tools(function (Form\Tools $tools) {
                $tools->disableDelete();
            });

        }
        else if(Admin::user()->isRole('教练员')){
            $form->display('id', __('教练员编号'))->disable();
            $form->text('name', __('姓名'))->required();
            $form->select('sex', __('性别'))->options(['男'=>'男','女'=>'女'])->required();
            $form->mobile('phone', __('电话号码'))->options(['mask' => '999 9999 9999'])->required();
            $form->text('wechat', __('微信'))->required()->required();
            $form->cropper('image',__('封面图'))->cRatio(300,300);
            $form->textarea('survey',__('概述'))->help('展示在浏览页,限制100字')->rules('required|max:220');
            $form->simditor('describe', __('简介'))->help('图片大小不得超过100K')->required();
            $form->fieldset('操作信息', function (Form $form) {
                $states = [
                    'on'  => ['value' => 1, 'text' => '通过', 'color' => 'success'],
                    'off' => ['value' => 2, 'text' => '不通过', 'color' => 'danger'],
                ];
                $form->switch('status', __('审核'))->states($states);
                $form->display('created_at', __('创建时间'));
                $form->display('updated_at', __('修改时间'));
            });
        }

        return $form;
    }
}
