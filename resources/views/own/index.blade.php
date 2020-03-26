<?php
/**
 * Created by PhpStorm.
 * User: Yip
 * Date: 2020/3/20
 * Time: 14:35
 */?>
@extends('layouts.app')
@section('title','个人信息')

@section('content')
    <div class="row">
        <div class="col-md-10 offset-lg-1">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">
                        个人信息
                    </h2>
                </div>
                <div class="card-body" >
                    @foreach($users as $user)
                        <form class="form-horizontal" role="form" action="" method="post">
                            <div class="form-group row">
                                <label class="col-form-label text-md-right col-sm-2">姓名</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ $user->name }}" readonly="true">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label text-md-right col-sm-2">性别</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ $user->sex }}" readonly="true">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label text-md-right col-sm-2">电话</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ $user->phone }}" readonly="true">
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label text-md-right col-sm-2">所属教练</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control" value="{{ $user->coach }}" readonly="true">
                                </div>
                            </div>
                        </form>
                    @endforeach
                        <a href="{{ route('root') }}" class="float-right">返回首页></a>
                </div>
            </div>
        </div>
    </div>
@endsection
