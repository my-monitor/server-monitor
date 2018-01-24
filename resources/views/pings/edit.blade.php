@extends('layouts.app')
@section('content')
    <div class="col-md-6 col-md-offset-3">
        <form action="{{ route('pings.update',$ping->id) }}" method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Create Ping
                    <div class="pull-right">
                        <button class="btn btn-primary btn-xs">UPDATE</button>
                    </div>
                </div>
                <div class="panel-body">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group col-md-12">
                        <label for="host_name">Name</label>
                        <input type="text" name="name" value="{{ old('name',$ping->name) }}" class="form-control">
                        @if($errors->has('name'))
                            <p class="text text-danger">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="host_url">Should run every: (in seconds)</label>
                        <input type="text" name="should_run_every" value="{{ old('should_run_every',$ping->uptime_check_interval_in_seconds) }}" class="form-control">
                        @if($errors->has('should_run_every'))
                            <p class="text text-danger">{{ $errors->first('should_run_every') }}</p>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                </div>
        </form>
    </div>
    </div>
@endsection