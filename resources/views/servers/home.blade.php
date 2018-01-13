@extends('layouts.app')
@section('content')
<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-default">
        <div class="panel-heading">
            Servers List
            <div class="pull-right">
                <a href="{{ route('servers.create') }}" class="btn btn-primary btn-xs">Add Server</a>
            </div>
        </div>
        <div class="panel-body">
            <table class="table table-bordered table-stripped">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Checks</th>
                    <th>Status</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    @foreach($hosts as $host)
                        <tr>
                            <td>{{ $host->id }}</td>
                            <td>{{ $host->name }}</td>
                            <td>{{ $host->checks->count() }}</td>
                            <td>{!! $host->getChecksStatuses() !!}</td>
                            <td><a href="#" class="btn btn-warning btn-xs">Edit</a></td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection