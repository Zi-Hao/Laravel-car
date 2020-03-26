<?php
/**
 * Created by PhpStorm.
 * User: Yip
 * Date: 2020/3/20
 * Time: 10:15
 */?>
@extends('layouts.app')
@section('title', ($contacts->id ? '查看': '提交') . '工单')

@section('content')
    <div class="row">
        <div class="col-md-10 offset-lg-1">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">
                        {{ $contacts->id ? '查看': '提交' }}工单
                    </h2>
                </div>
                <div class="card-body" >
                        @if($contacts->id)
                            <form class="form-horizontal" role="form" action="{{--{{ route('contact.update', ['contacts' => $contacts->id]) }}--}}" method="post">
                                {{ method_field('PUT') }}{{ csrf_field() }}
                                <div class="form-group row">
                                    <label class="col-form-label text-md-right col-sm-2">姓名</label>
                                    <div class="col-sm-9">
                                        <input type="text" class="form-control" name="name" value="{{ old('name', Auth::user()->name) }}" readonly="true">
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label class="col-form-label text-md-right col-sm-2">问题</label>
                                    <div class="col-sm-9">
                                        <textarea  class="form-control" name="problem"  style="height: 100px;" disabled>{{ old('problem', $contacts->problem) }}</textarea>
                                    </div>
                                </div>
                            </form>
                        <div class="card-body" style="border-top: 1px solid rgba(0, 0, 0, 0.125);">
                            管理员回复：{{ $contacts->reply }}
                        </div>
                        <a href="{{ route('contact.index') }}" class="float-right">返回工单列表></a>
                        @else
                             <form class="form-horizontal" role="form" action="{{ route('contact.store') }}" method="post">
                                 {{ csrf_field() }}
                                 <div class="form-group row">
                                     <label class="col-form-label text-md-right col-sm-2">姓名</label>
                                     <div class="col-sm-9">
                                         <input type="text" class="form-control" name="name" value="{{ old('name', Auth::user()->name) }}" readonly="true">
                                     </div>
                                 </div>
                                 <div class="form-group row">
                                     <label class="col-form-label text-md-right col-sm-2">问题</label>
                                     <div class="col-sm-9">
                                         <textarea  class="form-control" name="problem"  style="height: 100px;" required>{{ old('problem', $contacts->problem) }}</textarea>
                                     </div>
                                 </div>
                                 <input type="hidden" name="complete" value="未完成">
                                 <div class="form-group row text-center">
                                     <div class="col-12">
                                         <button type="submit" class="btn btn-primary float-right">提交</button>
                                     </div>
                                 </div>
                             </form>
                        @endif
                </div>
            </div>
        </div>
    </div>
@endsection
