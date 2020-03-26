<?php
/**
 * Created by PhpStorm.
 * User: Yip
 * Date: 2020/3/19
 * Time: 16:32
 */?>
@extends('layouts.app')
@section('title', '教练员详情')

@section('content')
    <div class="card card-header" style="margin-bottom: 2cm;background-color: white;font-size: 18px;">
        <div class="card-header" style="background-color: white;font-size: 18px;">
            <form action="{{ route('coach.index') }}" class="search-form">
                <div class="form-row">
                    <div class="col-md-9">
                        教练员详情
                    </div>
                    <div class="col-md-3">

                    </div>
                </div>
            </form>
        </div>
        <div class="card-body products-list" style="padding-bottom: 0;">
            <div class="scd">
                <div class="scd_m">
                    <div class="news">
                            <dl class="clearfix">
                                <dd>
                                    <div class="title" > <h4>姓名：{{$coach->name}}</h4></div>
                                    <div class="title" > <h4>性别：{{$coach->sex}}</h4></div>
                                    <div class="title" > <h4>电话：{{$coach->phone}}</h4></div>
                                    <div class="title"style="border-bottom: 1px solid rgba(0, 0, 0, 0.125);" ><h4>微信：{{$coach->wechat}}</h4></div>
                                </dd>
                                简介：<div class="des">{!! $coach->describe !!}</div>
                            </dl>
                        <form action="{{route('coach.store')}}" method="post">
                            {{ csrf_field() }}
                            <input type="hidden" value="{{Auth::user()->name}}" name="name" readonly="true">
                            <input type="hidden" value="{{Auth::user()->sex}}" name="sex" readonly="true">
                            <input type="hidden" value="{{Auth::user()->phone}}" name="phone" readonly="true">
                            <input type="hidden" value="{{$coach->name}}" name="coach" readonly="true">
                            @if($users ==1)
                                <dd class="float-right" style="color: red">你已选择过教练，如需更换请于驾校管理员联系！</dd>
                                @else
                            <button type="submit" class="btn btn-primary float-right">选择此教练>></button>
                                @endif
                        </form>

                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
