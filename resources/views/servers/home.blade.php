@extends('layouts.app')
@section('content')
<div class="col-md-10 col-md-offset-1">
    <div class="panel panel-default">
        <div class="panel-heading">Servser List</div>
        <div class="panel-body">
            <table class="table table-bordered table-stripped">
                <thead>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Checks</th>
                    <th>Status</th>
                </thead>
                <tbody>
                    @foreach($hosts as $host)
                        <tr>
                            <td>{{ $host->id }}</td>
                            <td>{{ $host->name }}</td>
                            <td>{{ $host->checks->count() }}</td>
                            <td>{!! $host->getChecksStatuses() !!}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection