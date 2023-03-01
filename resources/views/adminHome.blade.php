@extends('layouts.app')
  
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>
                You are an Admin User.
                <div class="card-body">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>User Name</th>
                        <th>Points</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($users as $u)
                    <tr>
                       <td>{{ $u->name }}</td>
                        <td>{{ $u->points }}</td>
                    </tr>
                        
                    @endforeach
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection