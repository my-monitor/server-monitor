@extends('layouts.app')
@section('content')
    <div class="col-md-6 col-md-offset-3">
        <form action="{{ route('pings.store') }}" method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Create Server
                    <div class="pull-right">
                        <button class="btn btn-primary btn-xs">ADD</button>
                    </div>
                </div>
                <div class="panel-body">
                    {{ csrf_field() }}
                    <div class="form-group col-md-12">
                        <label for="host_name">Name</label>
                        <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                        @if($errors->has('name'))
                            <p class="text text-danger">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="host_url">Should run every: (in seconds)</label>
                        <input type="text" name="should_run_every" value="{{ old('should_run_every','60') }}" class="form-control">
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