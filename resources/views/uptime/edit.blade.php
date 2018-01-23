@extends('layouts.app')
@section('content')
    <div class="col-md-6 col-md-offset-3">
        <form action="{{ route('uptime.update',$host->id) }}" method="post">
            <div class="panel panel-default">
                <div class="panel-heading">
                    Create Server
                    <div class="pull-right">
                        <button class="btn btn-primary btn-xs">ADD</button>
                    </div>
                </div>
                <div class="panel-body">
                    {{ csrf_field() }}
                    {{ method_field('PUT') }}
                    <div class="form-group col-md-12">
                        <label for="host_name">Name</label>
                        <input type="text" name="name" value="{{ old('name',$host->name) }}" class="form-control">
                        @if($errors->has('name'))
                            <p class="text text-danger">{{ $errors->first('name') }}</p>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="host_url">URL</label>
                        <input type="text" name="url" value="{{ old('url',$host->url) }}" class="form-control">
                        @if($errors->has('url'))
                            <p class="text text-danger">{{ $errors->first('url') }}</p>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="protocol">Which protocol needs to be used for checking</label>
                        <div class="col-md-6 row">
                            <label for="protocol-http">
                                <input type="radio" id="protocol-http" @if($host->protocol == 'http') checked @endif name="protocol" value="http">
                                HTTP
                            </label>
                        </div>
                        <div class="col-md-6 row">
                            <label for="protocol-https">
                                <input type="radio" id="protocol-https" @if($host->protocol == 'https') checked @endif name="protocol" value="https">
                                HTTPS
                            </label>
                        </div>
                        @if($errors->has('protocol'))
                            <p class="text text-danger">{{ $errors->first('protocol') }}</p>
                        @endif
                    </div>
                    <div class="form-group col-md-12">
                        <label for="string">Should we look for a specific string on the response?</label>
                        <input type="text" name="string" class="form-control" value="{{ old('string',$host->look_for_string) }}">
                        @if($errors->has('string'))
                            <p class="text text-danger">{{ $errors->first('string') }}</p>
                        @endif
                    </div>
                    <div class="clearfix"></div>
                </div>
        </form>
    </div>
    </div>
@endsection