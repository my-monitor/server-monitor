@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/styles/github.min.css">
@endsection
@section('content')
    <div class="col-md-4">
        <div class="panel panel-default">
            <div class="panel-heading">
                {{ $server->name }}
                <div class="pull-right">
                    <a href="{{ route('servers.edit',$server->id) }}" class="btn btn-primary btn-xs">Edit</a>
                </div>
            </div>
            <div class="panel-body">
                <div class="form-group col-md-12">
                    <label for="host_name">Host Name</label>
                    <input type="text" disabled value="{{ old('host_name',$server->name) }}" class="form-control">
                    @if($errors->has('host_name'))
                        <p class="text text-danger">{{ $errors->first('host_name') }}</p>
                    @endif
                </div>
                <div class="form-group col-md-12">
                    <label for="host_ip">Host IP</label>
                    <input type="text" disabled value="{{ old('host_ip',$server->ip) }}" class="form-control">
                    @if($errors->has('host_ip'))
                        <p class="text text-danger">{{ $errors->first('host_ip') }}</p>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="ssh_user">SSH User</label>
                    <input type="text" disabled class="form-control"
                           value="{{ old('ssh_user',$server->ssh_user,'root') }}">
                    @if($errors->has('ssh_user'))
                        <p class="text text-danger">{{ $errors->first('ssh_user') }}</p>
                    @endif
                </div>
                <div class="form-group col-md-6">
                    <label for="ssh_port">SSH Port</label>
                    <input type="text" disabled class="form-control" value="{{ old('ssh_port',$server->port,'22') }}">
                    @if($errors->has('ssh_port'))
                        <p class="text text-danger">{{ $errors->first('ssh_port') }}</p>
                    @endif
                </div>
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="panel panel-default">
            <div class="panel-heading">
                Checks List
            </div>
            <div class="panel-body">
                @foreach($server->checks as $check)
                <div class="form-group col-md-12">
                    <div class="form-group">
                        <b>{{ strtoupper($check->type) }} {!! $check->getHtmlStatus() !!}</b>
                    </div>
                    <div class="form-group">
                        <b>Last Message:</b> {{ $check->last_run_message }}
                    </div>
                    <div class="form-group row">
                        <div class="col-md-6">
                            <b>Last Check:</b> {{ $check->last_ran_at->diffForHumans(\Carbon\Carbon::now()) }}
                        </div>
                        <div class="col-md-6">
                            <b>Next Check:</b> {{ $check->last_ran_at->addMinutes($check->next_run_in_minutes)->diffForHumans(\Carbon\Carbon::now()) }}
                        </div>
                    </div>
                    <div class="form-group">
                        <b>Last Output Message:</b>
                        <a role="button" data-toggle="collapse" href="#{{ $check->id }}-output" aria-expanded="false" aria-controls="{{ $check->id }}-output">
                            Show
                        </a>
                        <div class="collapse" id="{{ $check->id }}-output">
                            <pre><code class="html">{!! $check->last_run_output['output'] !!}</code></pre>
                        </div>
                    </div>
                </div>
                <div class="clearfix"></div>
                <hr>
                @endforeach
                <div class="clearfix"></div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/highlight.js/9.12.0/highlight.min.js"></script>
    <script>
        hljs.initHighlightingOnLoad();
    </script>
@endsection