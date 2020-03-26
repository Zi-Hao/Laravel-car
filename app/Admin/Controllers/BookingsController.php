<?php

namespace App\Admin\Controllers;

use App\Models\Booking;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use Carbon\Carbon;
use DB;

class BookingsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '科目预约管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Booking());

        if (Admin::user()->isAdministrator()) {
            $grid->column('id', __('预约编号'));
            $grid->column('name', __('姓名'));
            $grid->column('coach', __('所属教练'));
            $grid->column('subject', __('预约科目'));
            $grid->complete('完成度')->display(function ($complete){
                if ($complete==1){
                    return $complete='<span style="color: green;font-weight: bold">'.'完成'. '</span>';
                }elseif ($complete == 2){
                    return $complete='<span style="color: red;font-weight: bold">'.'未完成'. '</span>';
                }elseif ($complete == 0){
                    return $complete='<span style="color: deepskyblue;font-weight: bold">'.'训练未开始'. '</span>';
                }
            });
            $grid->booking_time('预约时间')->display(function ($booking_time){
                if ($booking_time < Carbon::now()->toDateString()){
                    return $booking_time='<span style="color: red;font-weight: bold">'.'预约时间已过'. '</span>';
                }
                return $booking_time;
            });

            $grid->column('created_at',__('创建预约时间'))->date('Y-m-d');

            admin_warning('提醒', '谨慎操作！修改前请与学员和教练员沟通！');//提醒谨慎操作

            $grid->filter(function($filter){
                $filter->disableIdFilter(); // 去掉默认的 id 过滤器
                $filter->like('name', '姓名');// 添加新的字段过滤器（通过姓名过滤）
                $filter->in('booking_subject','预约科目')->checkbox([
                    '理论学习阶段'=>'理论学习阶段',
                    '科目一'=>'科目一',
                    '科目二'=>'科目二',
                    '科目三'=>'科目三',
                    '科目四'=>'科目四',
                    '取得驾照'=>'取得驾照'
                ]);
                $filter->in('complete','完成度')->checkbox([
                    '1'=>'完成',
                    '2'=>'未完成',
                    '0' =>'训练未开始',

                ]);
            });
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableView();// 隐藏查看按钮
            });
        }
        else if (Admin::user()->isRole('驾校管理员')) {//判断是否为驾校管理员
            $grid->column('id', __('预约编号'));
            $grid->column('name', __('姓名'));
            $grid->column('coach', __('所属教练'));
            $grid->column('subject', __('预约科目'));
            $grid->complete('完成度')->display(function ($complete){
                if ($complete==1){
                    return $complete='<span style="color: green;font-weight: bold">'.'完成'. '</span>';
                }elseif ($complete == 2){
                    return $complete='<span style="color: red;font-weight: bold">'.'未完成'. '</span>';
                }elseif ($complete == 0){
                    return $complete='<span style="color: deepskyblue;font-weight: bold">'.'训练未开始'. '</span>';
                }
            });
            $grid->booking_time('预约时间')->display(function ($booking_time){
                if ($booking_time < Carbon::now()->toDateString()){

                    return $booking_time='<span style="color: red;font-weight: bold">'.'预约时间已过'. '</span>';
                }
                return $booking_time;
            });
            $grid->column('created_at',__('创建预约时间'))->date('Y-m-d');

            admin_warning('提醒', '谨慎操作！修改前请与学员和教练员沟通！');//提醒谨慎操作

            $grid->filter(function($filter){
                $filter->disableIdFilter(); // 去掉默认的 id 过滤器
                $filter->like('name', '姓名');// 添加新的字段过滤器（通过姓名过滤）
                $filter->in('booking_subject','预约科目')->checkbox([
                    '理论学习阶段'=>'理论学习阶段',
                    '科目一'=>'科目一',
                    '科目二'=>'科目二',
                    '科目三'=>'科目三',
                    '科目四'=>'科目四',
                    '取得驾照'=>'取得驾照'
                ]);
                $filter->in('complete','完成度')->checkbox([
                    '1'=>'完成',
                    '2'=>'未完成',
                    '0' =>'训练未开始',

                ]);
            });
            $grid->disableCreateButton();//隐藏新增按钮
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableView();// 隐藏查看按钮
            });
        }
        else if (Admin::user()->isRole('教练员')){
            $grid->column('id', __('预约编号'));
            $grid->column('name', __('姓名'));
            $grid->column('coach', __('所属教练'));
            $grid->column('subject', __('预约科目'));

            $grid->complete('完成度')->display(function ($complete){
                if ($complete==1){
                    return $complete='<span style="color: green;font-weight: bold">'.'完成'. '</span>';
                }elseif ($complete == 2){
                    return $complete='<span style="color: red;font-weight: bold">'.'未完成'. '</span>';
                }elseif ($complete == 0){
                    return $complete='<span style="color: deepskyblue;font-weight: bold">'.'训练未开始'. '</span>';
                }
            });
            $grid->booking_time('预约时间')->display(function ($booking_time){
                if ($booking_time < Carbon::now()->toDateString()){

                    return $booking_time='<span style="color: red;font-weight: bold">'.'预约时间已过'. '</span>';
                }
                return $booking_time;
            });

            $grid->model()->where('coach',Admin::user()->name);//获取教练员名字取教练的学员名单

            $grid->column('created_at',__('创建预约时间'))->date('Y-m-d');
            $grid->disableExport();
            $grid->disableRowSelector();
            $grid->disableCreateButton();
            $grid->actions(function (Grid\Displayers\Actions $actions) {
                $actions->disableDelete();// 隐藏删除按钮
                $actions->disableView();// 隐藏查看按钮
            });
            $grid->filter(function($filter){
                $filter->disableIdFilter(); // 去掉默认的 id 过滤器
                $filter->like('name', '姓名');// 添加新的字段过滤器（通过姓名过滤）
                $filter->in('booking_subject','预约科目')->checkbox([
                    '理论学习阶段'=>'理论学习阶段',
                    '科目一'=>'科目一',
                    '科目二'=>'科目二',
                    '科目三'=>'科目三',
                    '科目四'=>'科目四',
                    '取得驾照'=>'取得驾照'
                ]);
                $filter->in('complete','完成度')->checkbox([
                    '1'=>'完成',
                    '2'=>'未完成',
                    '0' =>'训练未开始',

                ]);
            });
        }

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Booking::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('name', __('Name'));
        $show->field('sex', __('Sex'));
        $show->field('phone', __('Phone'));
        $show->field('wechat', __('Wechat'));
        $show->field('image', __('Image'));
        $show->field('describe', __('Describe'));
        $show->field('status', __('Status'));
        $show->field('created_at', __('Created at'));
        $show->field('updated_at', __('Updated at'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Booking());

        if (Admin::user()->isAdministrator()) {
            //$coach = DB::table('student')->where('name',Admin::user()->name)->value('coach');
            $form->text('name', __('姓名'))->default(Admin::user()->name)->disable();
            //$form->text('coach',__('所属教练'))->default($coach)->disable();
            $form->select('subject', __('预约科目'))
                ->options(['理论学习阶段'=>'理论学习阶段','科目一'=>'科目一','科目二'=>'科目二','科目三'=>'科目三','科目四'=>'科目四','取得驾照'=>'取得驾照']);
            $form->date('booking_time', __('预约时间'))->default(date('Y-m-d'));
            $states = [
                'on'  => ['value' => 1, 'text' => '通过', 'color' => 'success'],
                'off' => ['value' => 2, 'text' => '不通过', 'color' => 'danger'],
            ];
            $form->switch('complete', __('完成度'))->states($states);
            $form->display('created_at', __('创建时间'));
            $form->display('updated_at', __('修改时间'));
            $form->disableReset();
            $form->disableEditingCheck();
            $form->disableCreatingCheck();
            $form->disableViewCheck();
            $form->tools(function (Form\Tools $tools) {
                $tools->disableView();// 去掉`查看`按钮
            });
            $form->footer(function ($footer) {
                $footer->disableReset();// 去掉`重置`按钮
                $footer->disableViewCheck();// 去掉`查看`checkbox
                $footer->disableEditingCheck();// 去掉`继续编辑`checkbox
                $footer->disableCreatingCheck(); // 去掉`继续创建`checkbox
            });
        }
        else if (Admin::user()->isRole('驾校管理员')) {//判断是否为驾校管理员
            $coach = DB::table('student')->where('name',Admin::user()->name)->value('coach');
            $form->text('name', __('姓名'))->default(Admin::user()->name);
            $form->text('coach',__('所属教练'))->default($coach);
            $form->select('subject', __('预约科目'))
                ->options(['理论学习阶段'=>'理论学习阶段','科目一'=>'科目一','科目二'=>'科目二','科目三'=>'科目三','科目四'=>'科目四','取得驾照'=>'取得驾照']);
            $form->date('booking_time', __('预约时间'))->default(date('Y-m-d'));
            $states = [
                'on'  => ['value' => 1, 'text' => '通过', 'color' => 'success'],
                'off' => ['value' => 2, 'text' => '不通过', 'color' => 'danger'],
            ];
            $form->switch('complete', __('完成度'))->states($states);
            $form->display('created_at', __('创建时间'));
            $form->display('updated_at', __('修改时间'));
            $form->disableReset();
            $form->disableEditingCheck();
            $form->disableCreatingCheck();
            $form->disableViewCheck();
            $form->tools(function (Form\Tools $tools) {
                $tools->disableView();// 去掉`查看`按钮
            });
            $form->footer(function ($footer) {
                $footer->disableReset();// 去掉`重置`按钮
                $footer->disableViewCheck();// 去掉`查看`checkbox
                $footer->disableEditingCheck();// 去掉`继续编辑`checkbox
                $footer->disableCreatingCheck(); // 去掉`继续创建`checkbox
            });
        }else if (Admin::user()->isRole('教练员')){
            $coach = DB::table('student')->where('name',Admin::user()->name)->value('coach');
            $form->text('name', __('姓名'))->default(Admin::user()->name)->disable();
            $form->text('coach',__('所属教练'))->default($coach)->disable();
            $form->text('subject', __('预约科目'))->disable();
            $form->date('booking_time', __('预约时间'))->default(date('Y-m-d'))->help('修改日期请与学员沟通');
            //$complete = DB::table('booking')->where('complete',2);
            /* if ($complete == 2){
                 $states = [
                     'on'  => ['value' => 1, 'text' => '通过', 'color' => 'success'],
                     'off' => ['value' => 2, 'text' => '不通过', 'color' => 'danger'],
                 ];
                 $form->switch('complete', __('完成度'))->states($states);
             }*/
            $states = [
                'on'  => ['value' => 1, 'text' => '通过', 'color' => 'success'],
                'off' => ['value' => 2, 'text' => '不通过', 'color' => 'danger'],
            ];
            $form->switch('complete', __('完成度'))->states($states);
            $form->display('created_at', __('创建时间'));
            $form->display('updated_at', __('修改时间'));
            $form->disableReset();
            $form->disableEditingCheck();
            $form->disableCreatingCheck();
            $form->disableViewCheck();
            $form->tools(function (Form\Tools $tools) {
                $tools->disableDelete();
                $tools->disableView();// 去掉`查看`按钮
            });
            $form->footer(function ($footer) {
                $footer->disableReset();// 去掉`重置`按钮
                $footer->disableViewCheck();// 去掉`查看`checkbox
                $footer->disableEditingCheck();// 去掉`继续编辑`checkbox
                $footer->disableCreatingCheck(); // 去掉`继续创建`checkbox
            });

        }

        return $form;
    }
}
