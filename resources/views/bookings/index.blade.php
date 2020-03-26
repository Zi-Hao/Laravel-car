@extends('layouts.app')
@section('title', '科目预约列表')

@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card panel-default">
                <div class="card-header">科目预约列表
                    @if($count == 5 )
                        <a class="float-right" >所有科目都已预约</a>
                        @else
                    <a href="{{ route('bookings.create') }}" class="float-right">新增预约科目</a>
                        @endif
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr><h4 style="color: red">请勿重复预约同一科目，若无法按时前往请提前一天修改时间。</h4></tr>
                        <tr>

                            <th>科目</th>
                            <th>预约时间</th>
                            <th>所属教练</th>
                            <th>完成情况</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($booking as $bookinges)
                            <tr>

                                <td>{{ $bookinges->subject }}</td>
                                <td>{{ $bookinges->booking_time }}</td>
                                <td>{{ $bookinges->coach }}</td>
                                @if($bookinges->complete ==1 )
                                    <td>完成</td>
                                @else
                                    <td>未完成</td>
                                @endif
                                <td>
                                    <a href="{{ route('bookings.edit', ['bookings' => $bookinges->id]) }}" class="btn btn-primary">修改</a>
                                    <form action="{{ route('bookings.destroy',  $bookinges->id) }}" method="post" style="display: inline-block">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-danger" type="submit">删除</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection