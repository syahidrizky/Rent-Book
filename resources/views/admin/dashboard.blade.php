@extends('layouts.main')

@section('title', 'Dashboard')

@section('content')
    <h3>Welcome, {{Auth::user()->username}}</h3>

<!-- Cards -->
    <div class="row mt-4">
        <div class="col-4">
            <div class="card-data books">
            <div class="row">
                <div class="col-6">
                    <i class="bi bi-journal-bookmark"></i>
                </div>
                <div class="col-6 d-flex flex-column justify-content-center">
                    <div class="desc">
                        Books
                    </div>
                    <div class="count">
                        {{$book_count}}
                    </div>
                </div>
            </div>
        </div>
    </div>
            <div class="col-4">
                <div class="card-data category">
                <div class="row">
                    <div class="col-6">
                        <i class="bi bi-journal-bookmark"></i>
                    </div>
                    <div class="col-6 d-flex flex-column justify-content-center">
                        <div class="desc">
                            Category
                        </div>
                        <div class="count">
                            {{$category_count}}
                        </div>
                    </div>
                </div>
                </div>
            </div>
                <div class="col-4">
                    <div class="card-data user">
                    <div class="row">
                        <div class="col-6">
                            <i class="bi bi-person-circle"></i>
                        </div>
                        <div class="col-6 d-flex flex-column justify-content-center">
                            <div class="desc">
                                User
                            </div>
                            <div class="count">
                                {{$user_count}}
                            </div>
                        </div>
                    </div>
                    </div>
                </div>
<!-- End Cards -->

<!-- Table Rent Logs -->
        <div class="mt4">
            <table class="table">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Username</th>
                        <th>Book Title</th>
                        <th>Rent Date</th>
                        <th>Return Date</th>
                        <th>Actual Return Date</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tr>
                    <td colspan="7" class="text-center">No Data</td>
                </tr>
            </table>
        </div>
<!-- Table Rent Logs -->
@endsection