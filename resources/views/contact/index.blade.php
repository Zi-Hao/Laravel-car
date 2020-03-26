@extends('layouts.app')
@section('title', '工单列表')

@section('content')
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="card panel-default">
                <div class="card-header">工单列表
                    <a href="{{ route('contact.create') }}" class="float-right">提交工单</a>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                        <tr><h4 style="color: red">管理员将在24小时内回复</h4></tr>
                        <tr>

                            <th>问题</th>
                            <th>回复进度</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $contact)
                            <tr>

                                <td>{{ $contact->problem }}</td>
                                @if($contact->status ==2 )
                                    <td>已处理</td>
                                    <td>
                                        <a href="{{ route('contact.edit', ['contacts' => $contact->id]) }}" class="btn btn-primary">查看详情></a>
                                    </td>
                                @else
                                    <td>待处理</td>
                                    <td>
                                        <a href="{{ route('contact.edit', ['contacts' => $contact->id]) }}" class="btn btn-primary">查看详情></a>
                                    </td>
                                @endif

                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection