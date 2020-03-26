<?php
/**
 * Created by PhpStorm.
 * User: Yip
 * Date: 2020/3/23
 * Time: 10:37
 */?>
@extends('layouts.app')
@section('title', '文章详情')
@section('content')
    <div class="card card-header" style="margin-bottom: 2cm;background-color: white;font-size: 18px;">
        <div class="card-header" style="background-color: white;font-size: 18px;">
            <form action="{{ route('articles.index') }}" class="search-form">
                <div class="form-row">
                    <div class="col-md-9">
                        <a href="{{ route('articles.index') }}">文章列表</a>/详情
                    </div>

                </div>
            </form>
        </div>
        <div class="card-body products-list" style="padding-bottom: 0;">
            <div class="scd">
                <div class="scd_m">
                    <div class="news">
                        <dl class="clearfix">
                                <div class="title" > <center><h2>{{$artcile->title}}</h2></center></div>
                                <div class="title" style="font-size: 12px"> <center>作者：{{$artcile->name}}发布时间：{{$artcile->created_at}}</center></div>
                            <br/>
                            <br/>
                           <div class="des">{!! $artcile->content !!}</div>
                        </dl>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
