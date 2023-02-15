@extends('layouts.main')

@section('title', 'Registered User')
    
@section('content')
<h1>Registered User</h1>    

<div class="mt-4 d-flex justify-content-end">
    <a href="/users" class="btn btn-primary me-3">Approve User List</a>
</div>
<div class="mt-4">
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <td>No</td>
                <td>Username</td>
                <td>Phone</td>
                <td>Action</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($usersRegistered as $item)
            <tr>
                <td>{{$loop->iteration}}</td>
                <td>{{$item->username}}</td>
                <td>{{$item->phone}}</td>
                <td>
                    <a href="/users-detail/{{$item->slug}}" class="btn btn-success me-3">Detail</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection