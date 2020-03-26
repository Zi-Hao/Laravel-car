<?php

namespace App\Admin\Controllers;

use App\Models\Contact;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class ContactsController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '工单管理';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Contact());

        $grid->column('id', __('工单编号'));
        $grid->column('problem', __('问题'));
        $grid->status('处理情况')->display(function ($status){
            if ($status==2){
                return $status='<span style="color: green;font-weight: bold">'.'已处理'. '</span>';
            }else{
                return $status='<span style="color: deepskyblue;font-weight: bold">'.'待处理'. '</span>';
            }
        });
        $grid->column('created_at', __('创建时间'))->date('Y-m-d H:i:s');
        $grid->column('updated_at', __('回复时间'))->date('Y-m-d H:i:s');
        $grid->actions(function (Grid\Displayers\Actions $actions) {
            $actions->disableView();// 隐藏查看按钮
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
        $form = new Form(new Contact());

        $form->text('name', __('姓名'))->disable();
        $form->textarea('problem', __('问题'))->disable();
        $states = [
            'on'  => ['value' => 2, 'text' => '已处理', 'color' => 'success'],
            'off' => ['value' => 1, 'text' => '待处理', 'color' => 'danger'],
        ];
        $form->switch('status', __('处理进度'))->states($states);
        $form->textarea('reply', __('回复'));

        return $form;
    }
}
