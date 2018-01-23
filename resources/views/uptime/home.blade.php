@extends('layouts.app')
@section('content')
<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            Uptime Servers List
            <div class="pull-right">
                <a href="{{ route('uptime.create') }}" class="btn btn-primary btn-xs">Add Server</a>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-stripped">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
                    <th>Stable Since</th>
                    <th>Last Check</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($hosts as $host)
                        <tr>
                            <td>{{ $host->id }}</td>
                            <td>{{ $host->name }}</td>
                            <td>{!! $host->getChecksStatuses() !!}</td>
                            <td>
                                @if($host->uptime_status_last_change_date)
                                {{ str_replace(' before','',$host->uptime_status_last_change_date->diffForHumans(\Carbon\Carbon::now())) }}
                                @endif
                            </td>
                            <td>
                                @if($host->uptime_last_check_date)
                                {{ str_replace(' before','',$host->uptime_last_check_date->diffForHumans(\Carbon\Carbon::now())) }}
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('uptime.edit',$host->id) }}" class="btn btn-warning btn-xs">Edit</a>
                                <a href="{{ route('uptime.show',$host->id) }}" class="btn btn-primary btn-xs">Show</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection