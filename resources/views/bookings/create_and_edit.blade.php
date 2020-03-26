@extends('layouts.app')
@section('title', ($bookings->id ? '修改': '新增') . '预约科目')

@section('content')
    <div class="row">
        <div class="col-md-10 offset-lg-1">
            <div class="card">
                <div class="card-header">
                    <h2 class="text-center">
                        {{ $bookings->id ? '修改': '新增' }}预约科目
                    </h2>
                </div>
                <div class="card-body">
                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <h4>有错误发生：</h4>
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li><i class="glyphicon glyphicon-remove"></i> {{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <user-addresses-create-and-edit>
                        @if($bookings->id)
                            <form class="form-horizontal" role="form" action="{{ route('bookings.update', ['bookings' => $bookings->id]) }}" method="post">{{ method_field('PUT') }}{{ csrf_field() }}
                        @else
                            <form class="form-horizontal" role="form" action="{{ route('bookings.store') }}" method="post">{{ csrf_field() }}
                        @endif
                            <div class="form-group row">
                                <label class="col-form-label text-md-right col-sm-2">姓名</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', Auth::user()->name) }}" readonly="true">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label text-md-right col-sm-2">所属教练</label>
                                <div class="col-sm-9">
                                    <input type="text" class="form-control @error('coach') is-invalid @enderror" name="coach" value="{{ old('coach', $students) }}" readonly="true">
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="col-form-label text-md-right col-sm-2">预约科目</label>
                                <div class="col-sm-9">
                                    <select class="form-control @error('subject') is-invalid @enderror" name="subject"  value="{{ old('subject', $bookings->subject) }}">
                                        <option value="科目一">{{ old('subject', $bookings->subject) }}</option>
                                        <option value="科目一">科目一</option>
                                        <option value="科目二">科目二</option>
                                        <option value="科目三">科目三</option>
                                        <option value="科目四">科目四</option>
                                        <option value="理论学习">理论学习阶段</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row">
                                <label class="col-form-label text-md-right col-sm-2">预约时间</label>
                                <div class="col-sm-9">
                                    <input type="date" class="form-control @error('booking_time') is-invalid @enderror" name="booking_time" value="{{ old('booking_time', $bookings->booking_time) }}">
                                </div>
                            </div>
                        <input type="hidden" name="complete" value="未完成">
                        <div class="form-group row text-center">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary float-right">提交</button>
                            </div>
                        </div>
                    </form>
                    </user-addresses-create-and-edit>
                </div>
            </div>
        </div>
    </div>
@endsection