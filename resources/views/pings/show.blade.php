@extends('layouts.app')
@section('content')
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ $ping->name }}
                <div class="pull-right">
                    <a href="{{ route('pings.edit',$ping->id) }}" class="btn btn-primary btn-xs">Edit</a>
                </div>
            </div>
            <div class="panel-body">
                <div class="form-group col-md-12">
                    <label>Name</label>
                    <input type="text" disabled value="{{ $ping->name }}" class="form-control">
                </div>
                <div class="form-group col-md-12">
                    <label>Should run every: (in seconds)</label>
                    <input type="text" disabled value="{{ $ping->uptime_check_interval_in_seconds }}" class="form-control">
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">API Route:</div>
            <div class="panel-body">
                <div class="col-md-12">
                    <input type="text" class="form-control" disabled value="{{ 'curl -H "Authorization: Bearer <ACCESS_TOKEN>" '.route('ping.api',$ping->key) }}">
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-body">
                <div class="form-group">
                    <b>Status:</b> {!! $ping->getChecksStatuses() !!}
                    <hr>
                </div>
                <div class="form-group">
                    <div class="col-md-6 row">
                        <b>Last Check:</b>
                        @if($ping->uptime_last_check_date)
                            {{ str_replace(' before','',$ping->uptime_last_check_date->diffForHumans(\Carbon\Carbon::now())) }}
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                Logs
            </div>
            <div class="panel-body">
                @if($ping->logs->count() > 0)
                    <table class="table table-bordered table-stripped">
                        <thead>
                            <th>User ID</th>
                            <th>Pinged at</th>
                        </thead>
                        <tbody>
                        @foreach($ping->logs as $log)
                            <tr>
                                <td>{{ $log->user->name }}</td>
                                <td>{{ $log->created_at }}</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-warning">No logs available</div>
                @endif
            </div>
        </div>
    </div>
@endsection
