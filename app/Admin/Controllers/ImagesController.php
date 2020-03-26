<?php

namespace App\Admin\Controllers;

use App\Models\Image;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Facades\Admin;
use DB;

class ImagesController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '轮播图管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        admin_warning('提醒', '最多发布三张轮播图');
        $grid = new Grid(new Image());
        if (Admin::user()->isAdministrator()) {//权限控制
            $grid->column('id', __('编号'));
            $grid->column('image', __('图片'))->image();
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
            $grid->column('updated_at', __('修改时间'))->date('Y-m-d H:i:s');
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableView();// 隐藏查看按钮
            });
        }
        else if(Admin::user()->isRole('驾校管理员')) {
            $grid->column('id', __('编号'));
            $grid->column('image', __('图片'));
            $grid->release('发布状态')->display(function ($release){
                if ($release==1){
                    return $release='<span style="color: green;font-weight: bold">'.'已发布'. '</span>';
                }else{
                    return $release='<span style="color: darkred;font-weight: bold">未发布</span>';
                }
            });
            $grid->column('created_at', __('创建时间'))->date('Y-m-d H:i:s');
            $grid->column('updated_at', __('修改时间'))->date('Y-m-d H:i:s');
            $count = DB::table('image')->count();
            if ($count ==3){
                $grid->actions(function (Grid\Displayers\Actions $actions) {
                    $actions->disableView();// 隐藏查看按钮
                    $actions->disableDelete();//隐藏删除按钮
                });
            }else{
                $grid->actions(function (Grid\Displayers\Actions $actions) {
                    $actions->disableView();// 隐藏查看按钮
                });
            }
        }
        else if(Admin::user()->isRole('运营')){
            $grid->column('id', __('编号'));
            $grid->column('image', __('图片'));
            $grid->release('发布状态')->display(function ($release){
                if ($release==1){
                    return $release='<span style="color: green;font-weight: bold">'.'已发布'. '</span>';
                }else{
                    return $release='<span style="color: darkred;font-weight: bold">未发布</span>';
                }
            });
            $grid->column('created_at', __('创建时间'))->date('Y-m-d H:i:s');
            $grid->column('updated_at', __('修改时间'))->date('Y-m-d H:i:s');
            $count = DB::table('image')->count();
            if ($count ==3){
                $grid->actions(function (Grid\Displayers\Actions $actions) {
                    $actions->disableView();// 隐藏查看按钮
                    $actions->disableDelete();//隐藏删除按钮
                });
            }else{
                $grid->actions(function (Grid\Displayers\Actions $actions) {
                    $actions->disableView();// 隐藏查看按钮
                });
            }
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
        $form = new Form(new Image());

        //$form->cropper('image',__('封面图'));
        $form->image('image')->uniqueName();
        $count = DB::table('image')->where('release',1)->count();
        if ($count == 3){
            $release = [
                'on'  => ['value' => 1, 'text' => '发布', 'color' => 'success'],
                'off' => ['value' => 2, 'text' => '不发布', 'color' => 'danger'],
            ];
            $form->switch('release', __('发布状态'))->states($release)->disable()->help('已达到发布上限');
        }else{
            $release = [
                'on'  => ['value' => 1, 'text' => '发布', 'color' => 'success'],
                'off' => ['value' => 2, 'text' => '不发布', 'color' => 'danger'],
            ];
            $form->switch('release', __('发布状态'))->states($release);
        }



        return $form;
    }
}
