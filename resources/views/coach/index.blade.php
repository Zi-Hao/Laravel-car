<?php
/**
 * Created by PhpStorm.
 * User: Yip
 * Date: 2020/3/19
 * Time: 15:10
 */?>

@extends('layouts.app')
@section('title', '教练员浏览')

@section('content')
    <div class="card card-header" style="margin-bottom: 2cm;background-color: white;font-size: 18px;">
        <div class="card-header" style="background-color: white;font-size: 18px;">
            <form action="{{ route('coach.index') }}" class="search-form">
                <div class="form-row">
                    <div class="col-md-9">
                        教练员浏览
                    </div>
                    <div class="col-md-3">
                        <div class="form-row">
                            <div class="col-auto"><input type="text" class="form-control form-control-sm" name="search" placeholder="搜索"></div>
                            <div class="col-auto"><button class="btn btn-primary btn-sm">搜索</button></div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
        <div class="card-body products-list" style="padding-bottom: 0;">
            <div class="scd">
                <div class="scd_m">
                    <div class="news">
                        @foreach($coachs as $coach)
                            <dl class="clearfix">
                                <dt><a href=""><img src="uploads/{{$coach->image}}" alt=""/></a></dt>
                                <dd>
                                    <div class="title"><h4>{{$coach->name}}</h4></div>
                                    <div class="des" >{{$coach->survey}} </div>
                                    <a class="float-right btn btn-primary" style="margin-top: 20px;background-color: #61ADB5;"
                                       href="{{ route('coach.show', ['coach' => $coach->id]) }}" >查看详情>></a>
                                </dd>

                            </dl>

                        @endforeach
                    </div>
                </div>
            </div>
            <div class="float-right">{{ $coachs->render() }}</div>
        </div>
    </div>

@endsection
