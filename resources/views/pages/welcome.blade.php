<?php
/**
 * Created by PhpStorm.
 * User: Yip
 * Date: 2020/3/23
 * Time: 16:01
 */?>

@extends('layouts.app')
@section('title', '首页')

@section('content')
    <div class="card card-header" style="margin-bottom: 2cm;background-color: white;font-size: 18px;">
        <div class="card-header" style="background-color: white;font-size: 18px;">
                <div class="form-row">
                    <div class="col-md-9">
                        欢迎登录 {{Auth::user()->name}}
                    </div>

                </div>
        </div>
       {{-- @if($count == 0)--}}
            {{--<div class="card-body products-list" style="padding-bottom: 0;">
                <div class=" text-center">
                    驾校信息未发布...<br/>
                    敬请等待...
                </div>
            </div>--}}
        {{--@else--}}

                <div class="card-body products-list" style="padding-bottom: 0;">
                    <div class="scd">
                        <div class="scd_m">
                            <div class="news">
                                <br class="clearfix">
                                    <div class="des"></div>
                                    <dd><h4>科目完成进度：{{$complete}}</h4></dd>
                                    <dd><h4>当前预约科目：{{$bookings}}</h4></dd>
                                    <dd><h4>你已学习 {{$time}} 天   </h4></dd>

                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

        {{--@endif--}}
    </div>
@endsection
