@extends('layouts.main')

@section('title', 'Users')
    
@section('content')
    <h1>Users</h1>
    <div class="mt-4 d-flex justify-content-end">
        <a href="/users-banned" class="btn btn-secondary me-3">View Ban User</a>
        <a href="/users-registered" class="btn btn-primary me-3">View New User</a>
    </div><br>
    @if (session('status'))
                <div class="alert alert-success text-center">
                    {{ session('status')}}
                </div>
            @endif
    <div class="mt-4">
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <td>No</td>
                    <td>Username</td>
                    <td>Phone</td>
                    <td>Address</td>
                    <td>Action</td>
                </tr>
            </thead>
            <tbody>
                @foreach($user as $value)
                <tr>
                    <td>{{$loop->iteration}}</td>
                    <td>{{$value->username}}</td>
                    <td>{{$value->phone}}</td>
                    <td>{{$value->address}}</td>
                    <td>
                        <a href="/users-detail/{{$value->slug}}"" class="btn btn-success me-3">Detail</a>
                        <a href="/users-ban/{{$value->slug}}" class="btn btn-danger me-3">Ban User</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection