@extends('layouts.app')
@section('title', '首页')

@section('content')
        <div class="row clearfix">
            <div class="col-md-12 column">

                <div id="demo" class="carousel slide" data-ride="carousel">

                      <!-- 轮播图片 -->
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                  <img src="storage/{{$image1}}" style="height: 394px;width: 100%">
                                </div>
                            <div class="carousel-item">
                                  <img src="storage/{{$image2}}" style="height: 394px;width: 100%">
                                </div>
                            <div class="carousel-item">
                                  <img src="storage/{{$image3}}" style="height: 394px;width: 100%">
                                </div>
                        </div>

                      <!-- 左右切换按钮 -->
                      <a class="carousel-control-prev" href="#demo" data-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                          </a>
                      <a class="carousel-control-next" href="#demo" data-slide="next">
                            <span class="carousel-control-next-icon"></span>
                          </a>

                </div>

            </div>
        </div>
        <div class="row clearfix" style="padding: 0;padding-bottom: 20px">
            <div class="col-md-8 column" >
                <div class="card-body" style="padding: 0;border-style: none none solid none;border-color: #61ADB5">
                    <h3>驾校简介</h3>
                </div>
                @foreach($car_content as $content)
                {!! $content->content !!}
                    @endforeach
            </div>

            <div class="col-md-4 column" >
            <div class="card-body " style="padding: 0;border-style: none none solid none;border-color: #61ADB5">
                <a href="{{route('articles.index')}}" style="float:right;padding-top: 10px;">更多文章>></a>
                <div class="col-md-5">
                    <h3>文章列表</h3>
                </div>

            </div>
                <ul >
                    @foreach($article as $articles)
                            <dl style="margin-top: 20px;"><a style="color:black;font-size: 18px" href="{{ route('articles.show', ['articles' => $articles->id]) }}" >{{$articles->title }}</a></dl>
                    @endforeach
                </ul>

            </div>
        </div>
        <div class="card-body" style="padding: 0;border-style: none none solid none;border-color: #61ADB5">
            <h3>优秀教练</h3>
        </div>
        <div class="row clearfix" style="padding-bottom: 20px;padding-top: 20px">

            @foreach($coaches as $coach)

                <div class="col-md-4 column">

                    <h2>
                        {{$coach->name}}
                    </h2>
                    <p>
                       {{$coach->survey}}
                    </p>
                    <p>
                        <a class="btn" href="{{ route('coach.show', ['coach' => $coach->id]) }}">查看详情 »</a>
                    </p>
                </div>
            @endforeach
        </div>
@stop