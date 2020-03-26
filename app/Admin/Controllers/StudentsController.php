<?php

namespace App\Admin\Controllers;

use App\Models\Student;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;
use DB;

class StudentsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '学员管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Student());

        if (Admin::user()->isAdministrator()) {//判断是否为超级管理员

            $grid->header(function ($query) {//统计人数
                $data = $query->count('*');
                $complete = $query->where('complete','取得驾照')->count('*');
                $learn = $data - $complete;
                return "<div style='padding: 10px;'>总学员 ： $data 人 | 毕业： $complete 人 | 学习中：$learn 人</div>";
            });

            $grid->column('id', __('学员编号'));
            $grid->column('name', __('姓名'));
            $grid->column('sex', __('性别'));
            $grid->column('phone', __('电话号码'));
            $grid->column('coach', __('所属教练'));
            $grid->column('complete', __('完成度'));

            $grid->filter(function($filter){
                $filter->disableIdFilter();// 去掉默认的 id 过滤器
                $filter->like('name', '学员'); // 添加新的字段过滤器（通过姓名过滤）
                $filter->like('coach', '教练员');
                $filter->in('complete','完成度')->checkbox([
                    '理论学习阶段'=>'理论学习阶段',
                    '科目一'=>'科目一',
                    '科目二'=>'科目二',
                    '科目三'=>'科目三',
                    '科目四'=>'科目四',
                    '取得驾照'=>'取得驾照'
                ]);
            });

        }
        else if (Admin::user()->isRole('驾校管理员')){//判断是否为驾校管理员

            $grid->header(function ($query) {//统计人数
                $data = $query->count('*');
                $complete = $query->where('complete','取得驾照')->count('*');
                $learn = $data - $complete;
                return "<div style='padding: 10px;'>总学员 ： $data 人 | 毕业： $complete 人 | 学习中：$learn 人</div>";
            });

            $grid->column('id', __('学员编号'));
            $grid->column('name', __('姓名'));
            $grid->column('sex', __('性别'));
            $grid->column('phone', __('电话号码'));
            $grid->column('coach', __('所属教练'));
            $grid->column('complete', __('完成度'));

            $grid->disableCreateButton();//隐藏新增按钮
            $grid->disableRowSelector();//隐藏批量选择按钮

            $grid->filter(function($filter){
                $filter->disableIdFilter();// 去掉默认的 id 过滤器
                $filter->like('name', '学员');// 添加新的字段过滤器（通过姓名过滤）
                $filter->like('coach', '教练员');
                $filter->in('complete','完成度')->checkbox([
                    '理论学习阶段'=>'理论学习阶段',
                    '科目一'=>'科目一',
                    '科目二'=>'科目二',
                    '科目三'=>'科目三',
                    '科目四'=>'科目四',
                    '取得驾照'=>'取得驾照'
                ]);
            });

        }
        else if (Admin::user()->isRole('教练员')){//判断是否为教练员

            $grid->header(function ($query) {//统计学员数
                $data = $query->count('*');
                $complete = $query->where('complete','取得驾照')->count('*');
                $learn = $data - $complete;
                return "<div style='padding: 10px;'>总学员 ： $data 人 | 毕业： $complete 人 | 学习中：$learn 人</div>";

            });

            $grid->column('id', __('学员编号'));
            $grid->column('name', __('姓名'));
            $grid->column('sex', __('性别'));
            $grid->column('phone', __('电话号码'));
            $grid->column('coach', __('所属教练'));
            $grid->column('complete', __('完成度'));
            $grid->model()->where('coach',Admin::user()->name);//获取教练员名字取教练的学员名单

            $grid->disableExport();
            $grid->disableCreation();
            $grid->disableRowSelector();
            $grid->disableColumnSelector();
            $grid->disableCreateButton();
            $grid->actions(function ($actions) {
                $actions->disableDelete();
            });

            $grid->filter(function($filter){
                $filter->disableIdFilter(); // 去掉默认的 id 过滤器
                $filter->like('name', '姓名');// 添加新的字段过滤器（通过姓名过滤）
                $filter->in('complete','完成度')->checkbox([
                    '理论学习阶段'=>'理论学习阶段',
                    '科目一'=>'科目一',
                    '科目二'=>'科目二',
                    '科目三'=>'科目三',
                    '科目四'=>'科目四',
                    '取得驾照'=>'取得驾照'
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
        $show = new Show(Student::findOrFail($id));

        if (Admin::user()->isAdministrator()) {//判断是否为超级管理员

            $show->field('id', __('学员编号'));
            $show->field('name', __('姓名'));
            $show->field('sex', __('性别'));
            $show->field('phone', __('电话号码'));
            $show->field('coach', __('所属教练'));
            $show->field('complete', __('完成度'));

        }
        else if (Admin::user()->isRole('驾校管理员')){//判断是否为驾校管理员

            $show->field('id', __('学员编号'));
            $show->field('name', __('姓名'));
            $show->field('sex', __('性别'));
            $show->field('phone', __('电话号码'));
            $show->field('coach', __('所属教练'));
            $show->field('complete', __('完成度'));

            $show->panel()->tools(function ($tools){
                $tools->disableDelete();//隐藏删除按钮
            });

        }
        else if (Admin::user()->isRole('教练员')){//判断是否为教练员

            $show->field('id', __('学员编号'));
            $show->field('name', __('姓名'));
            $show->field('sex', __('性别'));
            $show->field('phone', __('电话号码'));
            $show->field('coach', __('所属教练'));
            $show->field('complete', __('完成度'));

            $show->panel()->tools(function ($tools){
                $tools->disableDelete();//隐藏删除按钮
            });
        }

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Student());

        if (Admin::user()->isAdministrator()) {//权限控制

            $form->text('name', __('姓名'));
            $form->select('sex', __('性别'))->options(['男'=>'男','女'=>'女']);
            $form->mobile('phone', __('电话号码'))->options(['mask' => '999 9999 9999'])->required();
            $form->text('coach', __('所属教练'));
            $form->select('complete', __('完成度'))
                ->options(['理论学习阶段'=>'理论学习阶段','科目一'=>'科目一','科目二'=>'科目二','科目三'=>'科目三','科目四'=>'科目四','取得驾照'=>'取得驾照']);

        }
        else if(Admin::user()->isRole('驾校管理员')) {

            $form->display('name', __('姓名'));
            $form->select('sex', __('性别'))->options(['男'=>'男','女'=>'女']);
            $form->mobile('phone', __('电话号码'))->options(['mask' => '999 9999 9999']);
            $form->text('coach', __('所属教练'));
            $form->select('complete', __('完成度'))
                ->options(['理论学习阶段'=>'理论学习阶段','科目一'=>'科目一','科目二'=>'科目二','科目三'=>'科目三','科目四'=>'科目四','取得驾照'=>'取得驾照']);

        }
        else if(Admin::user()->isRole('教练员')){
            $form->text('id', __('学员编号'))->disable();
            $form->display('name', __('姓名'));
            $form->select('sex', __('性别'))->options(['男'=>'男','女'=>'女']);
            $form->mobile('phone', __('电话号码'))->disable()->options(['mask' => '999 9999 9999']);
            $form->text('coach', __('所属教练'))->disable();
            $form->select('complete', __('完成度'))
                ->options(['理论学习阶段'=>'理论学习阶段','科目一'=>'科目一','科目二'=>'科目二','科目三'=>'科目三','科目四'=>'科目四','取得驾照'=>'取得驾照']);

            //隐藏按钮
            $form->disableReset();
            $form->disableEditingCheck();
            $form->disableCreatingCheck();
            $form->disableViewCheck();
            $form->tools(function (Form\Tools $tools) {
                $tools->disableDelete();
            });
        }

        return $form;
    }
}
