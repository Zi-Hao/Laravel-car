<?php
/**
 * Created by PhpStorm.
 * User: Yip
 * Date: 2020/3/23
 * Time: 10:37
 */?>
@extends('layouts.app')
@section('title','驾校文章浏览')
@section('content')
    <div class="card card-header" style="margin-bottom: 2cm;background-color: white;font-size: 18px;">
        <div class="card-header" style="background-color: white;font-size: 18px;">
            <div class="col-md-9">
                驾校文章浏览
            </div>
        </div>
        <div class="card-body products-list" style="padding-bottom: 0;">
            <div class="scd">
                <div class="scd_m">
                    <div class="news">
                        @foreach($articles as $article)
                            <dl class="clearfix">
                                <dt><a href=""><img src="uploads/{{$article->image}}" alt=""/></a></dt>
                                <dd>
                                    <div class="title"><h4>{{$article->title}}</h4></div>
                                    <div class="des" >{{$article->survey}} </div>
                                    <a class="float-right btn btn-primary" style="margin-top: 20px;background-color: #61ADB5;"
                                       href="{{ route('articles.show', ['articles' => $article->id]) }}" >查看详情>></a>
                                </dd>

                            </dl>

                        @endforeach
                    </div>
                </div>
            </div>
            <div class="float-right">{{ $articles->render() }}</div>
        </div>
    </div>
@endsection

