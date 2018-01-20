@extends('layouts.app')
@section('content')
    <div class="col-md-6 col-md-offset-3">
        <form action="{{ route('servers.update',$server->id) }}" method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Create Server
                    <div class="pull-right">
                        <button class="btn btn-primary btn-xs">Update</button>
                    </div>
                </div>
                <div class="panel-body">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group col-md-12">
                        <label for="host_name">Host Name</label>
                        <input type="text" name="host_name" value="{{ old('host_name',$server->name) }}" class="form-control">
                        @if($errors->has('host_name'))
                            <p class="text text-danger">{{ $errors->first('host_name') }}</p>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="host_ip">Host IP</label>
                        <input type="text" name="host_ip" value="{{ old('host_ip',$server->ip) }}" class="form-control">
                        @if($errors->has('host_ip'))
                            <p class="text text-danger">{{ $errors->first('host_ip') }}</p>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ssh_user">SSH User</label>
                        <input type="text" name="ssh_user" class="form-control" value="{{ old('ssh_user',$server->ssh_user,'root') }}">
                        @if($errors->has('ssh_user'))
                            <p class="text text-danger">{{ $errors->first('ssh_user') }}</p>
                        @endif
                    </div>
                    <div class="form-group col-md-6">
                        <label for="ssh_port">SSH Port</label>
                        <input type="text" name="ssh_port" class="form-control" value="{{ old('ssh_port',$server->port,'22') }}">
                        @if($errors->has('ssh_port'))
                            <p class="text text-danger">{{ $errors->first('ssh_port') }}</p>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                    <hr>
                    <div class="form-group">
                        <label for="#">Checks: </label>
                    </div>
                    @foreach($checksList as $i => $check)
                        <div class="form-group col-md-4">
                            <label for="{{ $check }}">
                                <input type="checkbox" id="{{ $check }}" name="checks[]" value="{{ $check }}">
                                {{ strtoupper($check) }}
                            </label>
                            @if($errors->has('checks.'.$i))
                                <div class="text text-danger">
                                    {{ str_replace('checks.'.$i,$check,$errors->first('checks.'.$i)) }}
                                </div>
                            @endif
                        </div>
                    @endforeach
                    <div class="clearfix"></div>
                </div>
        </form>
    </div>
    </div>
@endsection