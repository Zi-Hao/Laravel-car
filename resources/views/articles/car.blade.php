<?php
/**
 * Created by PhpStorm.
 * User: Yip
 * Date: 2020/3/23
 * Time: 15:24
 */?>

@extends('layouts.app')
@section('title', '驾校详情')
@section('content')
    <div class="card card-header" style="margin-bottom: 2cm;background-color: white;font-size: 18px;">
        <div class="card-header" style="background-color: white;font-size: 18px;">
            <form action="{{ route('articles.index') }}" class="search-form">
                <div class="form-row">
                    <div class="col-md-9">
                        <a href="{{route('root')}}">首页</a>/驾校详情
                    </div>

                </div>
            </form>
        </div> @if($count == 0)
            <div class="card-body products-list" style="padding-bottom: 0;">
                <div class=" text-center">
                    驾校信息未发布...<br/>
                     敬请等待...
                </div>
            </div>
        @else
            @foreach($cars as $car)
                <div class="card-body products-list" style="padding-bottom: 0;">
                    <div class="scd">
                        <div class="scd_m">
                            <div class="news">
                                <dl class="clearfix">

                                    <br/>
                                    <br/>
                                    <div class="des">{!! $car->content !!}</div>

                                </dl>
                            </div>
                        </div>
                    </div>
                </div>

            @endforeach
        @endif
    </div>
@endsection
