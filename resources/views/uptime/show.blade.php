@extends('layouts.app')
@section('content')
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ $host->name }}
                <div class="pull-right">
                    <a href="{{ route('uptime.edit',$host->id) }}" class="btn btn-primary btn-xs">Edit</a>
                </div>
            </div>
            <div class="panel-body">
                <div class="form-group col-md-12">
                    <label>Name</label>
                    <input type="text" disabled value="{{ $host->name }}" class="form-control">
                </div>
                <div class="form-group col-md-12">
                    <label>URL</label>
                    <input type="text" disabled value="{{ $host->url }}" class="form-control">
                </div>
                <div class="form-group col-md-12">
                    <label>String to find in response</label>
                    <input type="text" disabled class="form-control" value="{{ $host->look_for_string }}">
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Info
            </div>
            <div class="panel-body">
                <div class="form-group">
                        <b>Check Status:</b>
                        @if($host->uptime_check_enabled)
                            <div class="label label-success">Enabled</div>
                        @else
                            <div class="label label-danger">Disabled</div>
                        @endif
                </div>
                <div class="form-group">
                    <div class="col-md-6 row">
                        <b>Last Check:</b> {{ $host->uptime_last_check_date->diffForHumans(\Carbon\Carbon::now()) }}
                    </div>
                    <div class="col-md-6 row">
                        <b>Check Every:</b> {{ Carbon\Carbon::now()->addMinutes($host->uptime_check_interval_in_minutes)->diffForHumans(\Carbon\Carbon::now()) }}
                    </div>
                </div>
                <div class="clearfix"></div>
                <hr>
                <div class="form-group">
                    <b>Ping Status:</b> {!! $host->getChecksStatuses() !!}
                </div>
                <div class="form-group col-md-12 row">
                        <b>Last failure message:</b> {{ !empty(trim($host->uptime_check_failure_reason)) ? $host->uptime_check_failure_reason : '-' }}
                </div>
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection
