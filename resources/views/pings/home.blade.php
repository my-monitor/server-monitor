@extends('layouts.app')
@section('content')
<div class="col-md-8 col-md-offset-2">
    @if(auth()->user()->liveTokens()->count() == 0)
        <div class="alert alert-danger">You need api key to use this service .. you can create a new key from <a href="{{ route('user.tokens') }}">here</a></div>
    @endif
    <div class="panel panel-default">
        <div class="panel-heading">
            Ping Services List
            <div class="pull-right">
                <a href="{{ route('pings.create') }}" class="btn btn-primary btn-xs">Add</a>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-stripped">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Last Ping</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($pings as $ping)
                        <tr>
                            <td>{{ $ping->id }}</td>
                            <td>{{ $ping->name }}</td>
                            <td>{!! $ping->getChecksStatuses() !!}</td>
                            <td>
                                @if($ping->uptime_last_check_date)
                                {{ str_replace(' before','',$ping->uptime_last_check_date->diffForHumans(\Carbon\Carbon::now())) }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('pings.edit',$ping->id) }}" class="btn btn-warning btn-xs">Edit</a>
                                <a href="{{ route('pings.show',$ping->id) }}" class="btn btn-primary btn-xs">Show</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection